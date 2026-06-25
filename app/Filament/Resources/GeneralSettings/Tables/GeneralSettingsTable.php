<?php

namespace App\Filament\Resources\GeneralSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\IconSize;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class GeneralSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->label(__('Setting Name'))
                    ->formatStateUsing(function ($state) {
                        return __($state);
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('value')
                    ->label(__('English Value'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('value_ar')
                    ->label(__('Arabic Value'))
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_published')
                    ->label(__('Published'))
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_published')
                    ->label(__('Published')),
                TrashedFilter::make(),
            ])
            ->recordActions([
                ReplicateAction::make()
                    ->color('gray')
                    ->iconSize(IconSize::Medium)
                    ->tooltip(__('Replicate'))
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
