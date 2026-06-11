<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

class UsersInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('name')
                            ->weight('bold')
                            ->size(TextSize::Medium)
                            ->label(__('Name')),
                        TextEntry::make('email')
                            ->weight('bold')
                            ->size(TextSize::Medium)
                            ->label(__('Email')),
                        TextEntry::make('phone_number')
                            ->weight('bold')
                            ->size(TextSize::Medium)
                            ->label(__('Phone Number')),
                        TextEntry::make('role.label_'. app()->getLocale())
                            ->weight('bold')
                            ->label(__('Role'))
                    ])->columnSpanFull(),
            ]);
    }
}
