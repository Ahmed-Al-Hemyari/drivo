<?php

namespace App\Filament\Resources\Cars\Tables;

use App\Filament\Resources\Brands\BrandResource;
use App\Filament\Resources\Categories\CategoryResource;
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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class CarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('brand.name_' . app()->getLocale())
                    ->label(__('Brand'))
                    ->url(fn($record) => BrandResource::getUrl('view', ['record' => $record->brand_id]))
                    ->color('primary')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('category.name_' . app()->getLocale())
                    ->label(__('Category'))
                    ->url(fn($record) => CategoryResource::getUrl('view', ['record' => $record->category_id]))
                    ->color('primary')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name_en')
                    ->searchable()
                    ->label(__('English Name'))
                    ->sortable(),
                TextColumn::make('name_ar')
                    ->searchable()
                    ->label(__('Arabic Name'))
                    ->sortable(),
                TextColumn::make('daily_price')
                    ->label(__('Price'))
                    ->formatStateUsing(function ($state) {
                        return $state . ' $';
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('is_available')
                    ->label(__('Available'))
                    ->alignCenter()
                    ->formatStateUsing(function ($state) {
                        // Updated to use strong solid backgrounds, bright white text, and matching borders
                        [$translatedText, $bg, $color, $border] = match ($state) {
                            true => [__('Available'), '#16A34A', '#FFFFFF', '#15803D'],   // Solid Green
                            false => [__('Unavailable'), '#DC2626', '#FFFFFF', '#B91C1C'], // Solid Red
                            default => [$state, '#4B5563', '#FFFFFF', '#374151'],                 // Solid Gray fallback
                        };

                        return new \Illuminate\Support\HtmlString(
                            "<span style='
                                background-color: {$bg};
                                color: {$color};
                                border: 1px solid {$border};
                                padding: 6px 20px;
                                border-radius: 6px;
                                font-size: 12px;
                                font-weight: 700;
                                display: inline-block;
                                line-height: 1;
                            '>{$translatedText}</span>"
                        );
                    }),
                TextColumn::make('rate')
                    ->label(__('Rate'))
                    ->formatStateUsing(function ($state) {
                        return $state . ' ★';
                    })
                    ->alignCenter()
                    ->placeholder(__('No reviews yet'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('brand_id')
                    ->label(__('Brand'))
                    ->relationship('brand', 'name_'. app()->getLocale())
                    ->searchable()
                    ->preload(),
                SelectFilter::make('category_id')
                    ->label(__('Category'))
                    ->relationship('category', 'name_'. app()->getLocale())
                    ->searchable()
                    ->preload(),
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
