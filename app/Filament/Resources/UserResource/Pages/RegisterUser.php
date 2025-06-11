<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Pages\Auth\Register as BaseRegister;

class RegisterUser extends BaseRegister
{
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function afterRegister(array $data): void
    {
        // Pindahkan logika ini ke dalam event listener jika aplikasi Anda lebih kompleks
        $user = $this->getUser();
        
        // Contoh: Kirim email selamat datang
        // Mail::to($user)->send(new WelcomeEmail($user));
    }
}