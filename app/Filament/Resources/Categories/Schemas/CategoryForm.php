<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->components([
                        TextInput::make('name_en')
                            ->label(__('English Name'))
                            ->required(),
                        TextInput::make('name_ar')
                            ->label(__('Arabic Name'))
                            ->required(),
                    ])
            ]);
    }
}
