<?php

namespace App\Filament\Resources\Roles\Schemas;

use App\Models\Role;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

class RoleInfolist
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
                        TextEntry::make('label_en')
                            ->weight('bold')
                            ->size(TextSize::Medium)
                            ->label(__('English Label')),
                        TextEntry::make('label_ar')
                            ->weight('bold')
                            ->size(TextSize::Medium)
                            ->label(__('Arabic Label')),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
