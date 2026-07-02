<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\IconSize;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('icon')->circular()->label(__('Icon'))
                    ->disk('public')
                    ->defaultImageUrl('/default-logo.png'),
                TextColumn::make('name_en')
                    ->label(__('English Name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name_ar')
                    ->label(__('Arabic Name'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
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
