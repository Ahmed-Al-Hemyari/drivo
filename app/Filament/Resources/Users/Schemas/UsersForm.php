<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UsersForm
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
                        TextInput::make('email')
                            ->label(__('Email'))
                            ->required(),
                        TextInput::make('phone_number')
                            ->label(__('Phone Number'))
                            ->required(),
                        Select::make('role')
                            ->label(__('Role'))
                            ->relationship('role', 'label_'. app()->getLocale())
                            ->preload()
                            ->searchable(),
                        TextInput::make('password')
                            ->label(__('Password'))
                            ->password()
                            ->required()
                            ->hiddenOn('edit')
                            ->minLength(8),
                        TextInput::make('password_confirmation')
                            ->label(__('Password Confirmation'))
                            ->password()
                            ->required()
                            ->hiddenOn('edit')
                            ->same('password'),
                    ]),
            ]);
    }
}
