<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),

                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->revealable()
                    ->required(fn(string $context): bool => $context === 'create')
                    ->dehydrated(fn($state) => filled($state))
                    ->maxLength(255),

                TextInput::make('password_confirmation')
                    ->label('Confirmar contraseña')
                    ->password()
                    ->revealable()
                    ->same('password')
                    ->required(fn(string $context): bool => $context === 'create')
                    ->dehydrated(false),

                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),

            ]);
    }
}
