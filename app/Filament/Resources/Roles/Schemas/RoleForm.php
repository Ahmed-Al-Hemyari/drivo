<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->components([
                        TextInput::make('name')
                            ->label(__('Name'))
                            ->required(),
                        TextInput::make('label_en')
                            ->label(__('English Label'))
                            ->required(),
                        TextInput::make('label_ar')
                            ->label(__('Arabic Label'))
                            ->required(),
                    ])
            ]);
    }
}
