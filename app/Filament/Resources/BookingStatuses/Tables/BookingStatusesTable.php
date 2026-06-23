<?php

namespace App\Filament\Resources\BookingStatuses\Tables;

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
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class BookingStatusesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_' . app()->getLocale())
                    ->searchable()
                    ->sortable()
                    ->label(__('Name'))
                    ->formatStateUsing(function ($state, $record) {
                        $bg = $record->background_color ?? '#6B7280';
                        $color = $record->font_color ?? '#FFFFFF';

                        return new \Illuminate\Support\HtmlString(
                            "<span style='
                                background-color: {$bg};
                                color: {$color};
                                padding: 4px 20px;
                                border-radius: 9999px;
                                font-size: 12px;
                                font-weight: 700;
                                display: inline-block;
                            '>{$state}</span>"
                        );
                    })
                    ->html(),
            ])
            ->filters([
                TrashedFilter::make()
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
