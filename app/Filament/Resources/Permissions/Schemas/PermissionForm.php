<?php

namespace App\Filament\Resources\Permissions\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PermissionForm
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
                        Checkbox::make('ViewAny')
                            ->label(__('View Any')),
                        Checkbox::make('View')
                            ->label(__('View')),
                        Checkbox::make('Create')
                            ->label(__('Create')),
                        Checkbox::make('Replicate')
                            ->label(__('Replicate')),
                        Checkbox::make('Update')
                            ->label(__('Update')),
                        Checkbox::make('Delete')
                            ->label(__('Delete')),
                        Checkbox::make('DeleteAny')
                            ->label(__('Delete Any')),
                        Checkbox::make('Restore')
                            ->label(__('Restore')),
                        Checkbox::make('RestoreAny')
                            ->label(__('Restore Any')),
                        Checkbox::make('ForceDelete')
                            ->label(__('Force Delete')),
                        Checkbox::make('ForceDeleteAny')
                            ->label(__('Force Delete Any')),
                        Select::make('role_id')
                            ->relationship('role', 'label_' . app()->getLocale())
                            ->label(__('Role'))
                            ->required(),
                    ])
            ]);
    }
}
