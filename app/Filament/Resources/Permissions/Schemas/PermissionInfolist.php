<?php

namespace App\Filament\Resources\Permissions\Schemas;

use App\Filament\Resources\Roles\RoleResource;
use App\Models\Permission;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

class PermissionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->components([
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
                        IconEntry::make('ViewAny')
                            ->boolean()
                            ->label(__('View Any')),
                        IconEntry::make('View')
                            ->boolean()
                            ->label(__('View')),
                        IconEntry::make('Create')
                            ->boolean()
                            ->label(__('Create')),
                        IconEntry::make('Replicate')
                            ->boolean()
                            ->label(__('Replicate')),
                        IconEntry::make('Update')
                            ->boolean()
                            ->label(__('Update')),
                        IconEntry::make('Delete')
                            ->boolean()
                            ->label(__('Delete')),
                        IconEntry::make('DeleteAny')
                            ->boolean()
                            ->label(__('Delete Any')),
                        IconEntry::make('Restore')
                            ->boolean()
                            ->label(__('Restore')),
                        IconEntry::make('RestoreAny')
                            ->boolean()
                            ->label(__('Restore Any')),
                        IconEntry::make('ForceDelete')
                            ->boolean()
                            ->label(__('Force Delete')),
                        IconEntry::make('ForceDeleteAny')
                            ->boolean()
                            ->label(__('Force Delete Any')),
                        TextEntry::make('role.label_'. app()->getLocale())
                            ->weight('bold')
                            ->size(TextSize::Medium)
                            ->label(__('Role'))
                            ->url(fn($record) => RoleResource::getUrl('view', ['record' => $record->role_id]))
                            ->color('primary'),
                    ])
            ]);
    }
}
