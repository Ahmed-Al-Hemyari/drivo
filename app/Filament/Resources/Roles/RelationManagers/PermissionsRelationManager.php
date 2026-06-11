<?php

namespace App\Filament\Resources\Roles\RelationManagers;

use App\Filament\Resources\Permissions\PermissionResource;
use App\Filament\Resources\Roles\Pages\EditRole;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PermissionsRelationManager extends RelationManager
{
    protected static string $relationship = 'permissions';

    protected static ?string $relatedResource = PermissionResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        // Hide the relationship table if the current page is the EditRole page
        return $pageClass !== EditRole::class;
    }
}
