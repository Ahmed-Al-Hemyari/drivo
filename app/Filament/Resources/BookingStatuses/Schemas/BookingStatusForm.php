<?php

namespace App\Filament\Resources\BookingStatuses\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BookingStatusForm
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
                        ColorPicker::make('background_color')
                            ->label(__('Background Color'))
                            ->required(),
                        ColorPicker::make('font_color')
                            ->label(__('Font Color'))
                            ->required(),
                    ]),
            ]);
    }
}
