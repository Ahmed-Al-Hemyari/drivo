<?php

namespace App\Filament\Resources\Brands\Schemas;

use App\Models\Brand;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

class BrandInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->components([
                        ImageEntry::make('logo')
                            ->label(__('Logo'))
                            ->disk('public')
                            ->defaultImageUrl('/default-logo.png')
                            ->imageHeight(200)
                            ->extraAttributes([
                                'class' => 'rounded-xl shadow-lg',
                            ]),
                        TextEntry::make('name_en')
                            ->label(__('English Name'))
                            ->weight('bold')
                            ->size(TextSize::Medium),
                        TextEntry::make('name_ar')
                            ->label(__('Arabic Name'))
                            ->weight('bold')
                            ->size(TextSize::Medium),
                        TextEntry::make('url')
                            ->label(__('URL'))
                            ->weight('bold')
                            ->size(TextSize::Medium)
                            ->formatStateUsing(fn () => __('Visit Website'))
                            ->url(fn ($state) => $state)
                            ->openUrlInNewTab()
                            ->color('primary'),
                    ])
            ]);
    }
}
