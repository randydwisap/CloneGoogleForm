<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormResource\Pages;
use App\Filament\Resources\FormResource\RelationManagers;
use App\Models\Form as FormModel;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString; // <-- Pastikan ini ada

class FormResource extends Resource
{
    protected static ?string $model = FormModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required()->columnSpanFull(),
                Textarea::make('description')->columnSpanFull(),

                Repeater::make('questions')
                    ->relationship()
                    ->schema([
                        TextInput::make('text')->label('Question Text')->required(),
                        Select::make('type')
                            ->options([
                                'text' => 'Text',
                                'textarea' => 'Textarea',
                                'select' => 'Select Menu',
                                'radio' => 'Radio Buttons',
                                'checkbox' => 'Checkboxes',
                            ])
                            ->required()
                            ->live(),
                        Toggle::make('is_required')->label('Required?'),
                        Repeater::make('options')
                            ->relationship()
                            ->schema([
                                TextInput::make('value')->required(),
                            ])
                            ->visible(fn (Get $get): bool => in_array($get('type'), ['select', 'radio', 'checkbox']))
                            ->label('Answer Options')
                            ->cloneable()
                            ->collapsible()
                            ->orderable('sort'), // Fitur urutan untuk pilihan jawaban
                    ])
                    ->orderable('order') // Fitur urutan untuk pertanyaan
                    ->collapsible()
                    ->cloneable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('slug')->label('Public URL Slug'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Action::make('copyLink')
                    ->label('Copy Link')
                    ->icon('heroicon-o-link')
                    ->color('gray')
                    ->action(null)
                    ->extraAttributes(function (FormModel $record) {
                        $url = route('public.form.show', $record);
                        return [
                            'x-on:click' => new HtmlString("
                                window.navigator.clipboard.writeText('{$url}');
                                \$tooltip('Link Copied!', {
                                    theme: 'success',
                                    timeout: 2000,
                                });
                            "),
                        ];
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\SubmissionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForms::route('/'),
            'create' => Pages\CreateForm::route('/create'),
            'edit' => Pages\EditForm::route('/{record}/edit'),
        ];
    }
}