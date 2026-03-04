<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\Schemas;

use App\Filament\Resources\Users\Pages\CreateUser;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

final class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('avatar')
                    ->label('Profielfoto')
                    ->image()
                    ->directory('avatars')
                    ->avatar()
                    ->nullable()
                    ->columnSpanFull(),
                TextInput::make('first_name')
                    ->label('Voornaam')
                    ->maxLength(255)
                    ->columnSpan(1)
                    ->required(),
                TextInput::make('last_name')
                    ->label('Achternaam')
                    ->maxLength(255)
                    ->columnSpan(1)
                    ->required(),
                TextInput::make('email')
                    ->label('E-mailadres')
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->unique()
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->label('Wachtwoord')
                    ->password()
                    ->required(fn ($livewire): bool => $livewire instanceof CreateUser)
                    ->revealable(filament()->arePasswordsRevealable())
                    ->rule(Password::default())
                    ->autocomplete('new-password')
                    ->dehydrated(fn ($state): bool => filled($state))
                    ->dehydrateStateUsing(fn ($state): string => Hash::make($state)),
                Select::make('roles')
                    ->label('Rollen')
                    ->multiple()
                    ->preload()
                    ->relationship('roles', 'name')
                    ->default(['1'])
                    ->required(),
            ])
            ->columns(2);
    }
}
