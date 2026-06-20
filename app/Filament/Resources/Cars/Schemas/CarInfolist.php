<?php

namespace App\Filament\Resources\Cars\Schemas;

use App\Filament\Resources\Brands\BrandResource;
use App\Filament\Resources\Categories\CategoryResource;
use App\Models\Car;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

class CarInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->components([
                        ImageEntry::make('images')
                            ->label(__('Images'))
                            ->disk('public')
                            ->defaultImageUrl('/none.png')
                            ->imageHeight(200)
                            ->extraAttributes([
                                'class' => 'rounded-xl shadow-lg',
                            ]),
                        TextEntry::make('brand.name_' . app()->getLocale())
                            ->label(__('Brand'))
                            ->weight('bold')
                            ->size(TextSize::Medium)
                            ->url(fn($record) => BrandResource::getUrl('view', ['record' => $record->brand_id]))
                            ->color('primary'),
                        TextEntry::make('category.name_' . app()->getLocale())
                            ->label(__('Category'))
                            ->weight('bold')
                            ->size(TextSize::Medium)
                            ->url(fn($record) => CategoryResource::getUrl('view', ['record' => $record->category_id]))
                            ->color('primary'),
                        TextEntry::make('name_en')
                            ->label(__('English Name'))
                            ->weight('bold')
                            ->size(TextSize::Medium),
                        TextEntry::make('name_ar')
                            ->label(__('Arabic Name'))
                            ->weight('bold')
                            ->size(TextSize::Medium),
                        TextEntry::make('daily_price')
                            ->label(__('Price'))
                            ->weight('bold')
                            ->formatStateUsing(function ($state) {
                                return $state . ' $';
                            })
                            ->size(TextSize::Medium),
                        TextEntry::make('rate')
                            ->label(__('Rate'))
                            ->weight('bold')
                            ->formatStateUsing(fn ($state) => "{$state} / 5")
                            ->placeholder(__('No reviews yet'))
                            ->size(TextSize::Medium),
                        TextEntry::make('status')
                            ->label(__('Status'))
                            ->formatStateUsing(function ($state) {
                                // Updated to use strong solid backgrounds, bright white text, and matching borders
                                [$translatedText, $bg, $color, $border] = match ($state) {
                                    'Available' => [__('Available'), '#16A34A', '#FFFFFF', '#15803D'],   // Solid Green
                                    'Unavailable' => [__('Unavailable'), '#DC2626', '#FFFFFF', '#B91C1C'], // Solid Red
                                    default => [$state, '#4B5563', '#FFFFFF', '#374151'],                 // Solid Gray fallback
                                };

                                return new \Illuminate\Support\HtmlString(
                                    "<span style='
                                        background-color: {$bg};
                                        color: {$color};
                                        border: 1px solid {$border};
                                        padding: 6px 20px;
                                        border-radius: 6px;
                                        font-size: 15px;
                                        font-weight: 700;
                                        display: inline-block;
                                        line-height: 1;
                                    '>{$translatedText}</span>"
                                );
                            }),
                    ])
            ]);
    }
}
