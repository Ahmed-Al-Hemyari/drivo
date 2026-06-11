<?php

namespace App\Filament\Resources\Roles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\IconSize;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RolesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('label_en')
                    ->label(__('English Label'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('label_ar')
                    ->label(__('Arabic Label'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ReplicateAction::make()
                    ->color('gray')
                    ->iconSize(IconSize::Medium)
                    ->tooltip(__('Replicate'))
                    ->label(''),
                ViewAction::make()
                    ->iconSize(IconSize::Medium)
                    ->color('gray')
                    ->tooltip(__('View'))
                    ->label(''),
                EditAction::make()
                    ->iconSize(IconSize::Medium)
                    ->color('gray')
                    ->tooltip(__('Edit'))
                    ->label(''),
                DeleteAction::make()
                    ->iconSize(IconSize::Medium)
                    ->tooltip(__('Delete'))
                    ->label('')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
