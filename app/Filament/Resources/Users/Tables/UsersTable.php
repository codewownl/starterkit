<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Profielfoto')
                    ->imageHeight(40)
                    ->circular(),
                TextColumn::make('name')
                    ->label('Naam')
                    ->sortable(query: fn ($query, string $direction) => $query->orderBy('first_name', $direction)->orderBy('last_name', $direction))
                    ->searchable(query: fn ($query, string $search) => $query->where(function ($query) use ($search): void {
                        $query->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                    })),
                TextColumn::make('email')
                    ->label('E-mailadres')
                    ->searchable(),
                IconColumn::make('email_verified_at')
                    ->label('E-mailadres geverifieerd')
                    ->icon(fn (string $state): string => match ($state) {
                        'null' => 'heroicon-o-clock',
                        default => 'heroicon-o-check-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'null' => 'warning',
                        default => 'success',
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
