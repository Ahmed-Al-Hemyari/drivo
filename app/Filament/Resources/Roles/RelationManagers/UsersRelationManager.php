<?php

namespace App\Filament\Resources\Roles\RelationManagers;

use App\Filament\Resources\Roles\Pages\EditRole;
use App\Filament\Resources\Users\UsersResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $relatedResource = UsersResource::class;

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
