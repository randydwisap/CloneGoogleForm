<?php

namespace App\Filament\Resources\FormResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables\Actions\ViewAction;

class SubmissionsRelationManager extends RelationManager
{
    protected static string $relationship = 'submissions';

    public function infolist(Infolist $infolist): Infolist
    {
    // Ambil submission dengan jawaban dan pertanyaan terkait
    $submission = $infolist->getRecord()->load('answers.question');
    $entries = [];

    foreach ($submission->answers as $answer) {
        $entries[] = TextEntry::make($answer->question->text) // Judulnya adalah teks pertanyaan
            ->label($answer->question->text) // Labelnya juga teks pertanyaan
            ->default(is_array(json_decode($answer->value, true)) // Tampilkan jawaban
                ? implode(', ', json_decode($answer->value, true))
                : $answer->value
            );
    }

    return $infolist->schema($entries);
    }

   public function table(Table $table): Table
    {
    return $table
        ->recordTitleAttribute('id')
        ->columns([
            Tables\Columns\TextColumn::make('id')->label('Submission ID'),
            Tables\Columns\TextColumn::make('created_at')->label('Submitted At')->dateTime(),
        ])
        ->filters([
            //
        ])
        ->headerActions([
            // Tables\Actions\CreateAction::make(), // Kita tidak membuat submission dari sini
        ])
        ->actions([
            ViewAction::make(), // Action untuk melihat detail jawaban
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }
}
