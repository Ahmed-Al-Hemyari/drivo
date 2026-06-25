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
                            ->placeholder('#000000')
                            ->helperText(__('Enter the color hex code starting with # (e.g., #000000)'))
                            ->regex('/^#[a-fA-F0-9]{6}$/')
                            ->validationMessages([
                                'regex' => __('The color format must be a valid hex code like #000000.'),
                            ])
                            ->required(),
                        TextInput::make('value_ar')
                            ->label(__('Arabic Value'))
                            ->placeholder('#000000')
                            ->helperText(__('Enter the color hex code starting with # (e.g., #000000)'))
                            ->regex('/^#[a-fA-F0-9]{6}$/')
                            ->validationMessages([
                                'regex' => __('The color format must be a valid hex code like #000000.'),
                            ])
                            ->required(),
                        Checkbox::make('is_published')
                            ->label(__('Published')),
                    ])
            ]);
    }
}
