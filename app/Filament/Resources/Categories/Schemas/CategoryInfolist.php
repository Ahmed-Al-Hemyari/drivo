<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

class CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->components([
                        TextEntry::make('name_en')
                            ->label(__('English Name'))
                            ->weight('bold')
                            ->size(TextSize::Medium),
                        TextEntry::make('name_ar')
                            ->label(__('Arabic Name'))
                            ->weight('bold')
                            ->size(TextSize::Medium),
                    ])
            ]);
    }
}
