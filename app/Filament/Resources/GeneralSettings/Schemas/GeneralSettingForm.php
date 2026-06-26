<?php

namespace App\Filament\Resources\GeneralSettings\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GeneralSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->components([
                        TextInput::make('key')
                            ->label(__('Setting Name'))
                            ->required(),
                        TextInput::make('value')
                            ->label(__('English Value'))
                            ->required(),
                        TextInput::make('value_ar')
                            ->label(__('Arabic Value')),
                        Checkbox::make('is_published')
                            ->label(__('Published')),
                    ])
            ]);
    }
}
