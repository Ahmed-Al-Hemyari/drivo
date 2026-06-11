<?php

namespace App\Filament\Resources\Permissions\Tables;

use App\Filament\Resources\Roles\RoleResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\IconSize;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class PermissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label(__('Name'))
                    ->sortable(),
                TextColumn::make('label_en')
                    ->searchable()
                    ->label(__('English Label'))
                    ->sortable(),
                TextColumn::make('label_ar')
                    ->searchable()
                    ->label(__('Arabic Label'))
                    ->sortable(),
                IconColumn::make('ViewAny')
                    ->searchable()
                    ->boolean()
                    ->alignment(Alignment::Center)
                    ->label(__('View Any'))
                    ->sortable(),
                IconColumn::make('View')
                    ->searchable()
                    ->boolean()
                    ->alignment(Alignment::Center)
                    ->label(__('View'))
                    ->sortable(),
                IconColumn::make('Create')
                    ->searchable()
                    ->boolean()
                    ->alignment(Alignment::Center)
                    ->label(__('Create'))
                    ->sortable(),
                IconColumn::make('Replicate')
                    ->searchable()
                    ->boolean()
                    ->alignment(Alignment::Center)
                    ->label(__('Replicate'))
                    ->sortable(),
                IconColumn::make('Update')
                    ->searchable()
                    ->boolean()
                    ->alignment(Alignment::Center)
                    ->label(__('Update'))
                    ->sortable(),
                IconColumn::make('Delete')
                    ->searchable()
                    ->boolean()
                    ->alignment(Alignment::Center)
                    ->label(__('Delete'))
                    ->sortable(),
                IconColumn::make('DeleteAny')
                    ->searchable()
                    ->boolean()
                    ->alignment(Alignment::Center)
                    ->label(__('Delete Any'))
                    ->sortable(),
                IconColumn::make('Restore')
                    ->searchable()
                    ->boolean()
                    ->alignment(Alignment::Center)
                    ->label(__('Restore'))
                    ->sortable(),
                IconColumn::make('RestoreAny')
                    ->searchable()
                    ->boolean()
                    ->alignment(Alignment::Center)
                    ->label(__('Restore Any'))
                    ->sortable(),
                IconColumn::make('ForceDelete')
                    ->searchable()
                    ->boolean()
                    ->alignment(Alignment::Center)
                    ->label(__('Force Delete'))
                    ->sortable(),
                IconColumn::make('ForceDeleteAny')
                    ->searchable()
                    ->boolean()
                    ->alignment(Alignment::Center)
                    ->label(__('Force Delete Any'))
                    ->sortable(),
                TextColumn::make('role.label_' . app()->getLocale())
                    ->searchable()
                    ->label(__('Role'))
                    ->url(fn($record) => RoleResource::getUrl('view', ['record' => $record->role_id]))
                    ->color('primary')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('role_id')
                    ->label(__('Role'))
                    ->relationship('role', 'label_'. app()->getLocale())
                    ->searchable()
                    ->preload(),
                TrashedFilter::make(),
            ])
            ->recordActions([
                ReplicateAction::make()
                    ->color('gray')
                    ->iconSize(IconSize::Medium)
                    ->tooltip(__('Replicate'))
                    ->label(''),
                ViewAction::make()
                    ->iconSize(IconSize::Medium)
                    ->color('gray')
                    ->tooltip(__('View'))
                    ->label(''),
                EditAction::make()
                    ->iconSize(IconSize::Medium)
                    ->color('gray')
                    ->tooltip(__('Edit'))
                    ->label(''),
                DeleteAction::make()
                    ->iconSize(IconSize::Medium)
                    ->tooltip(__('Delete'))
                    ->label('')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->paginationPageOptions([50, 100, 150])
            ->defaultPaginationPageOption(50);
    }
}
