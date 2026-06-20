<?php

namespace App\Filament\Resources\Categories\RelationManagers;

use App\Filament\Resources\Cars\CarResource;
use App\Filament\Resources\Categories\Pages\EditCategory;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CarsRelationManager extends RelationManager
{
    protected static string $relationship = 'Cars';

    protected static ?string $relatedResource = CarResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        return $pageClass !== EditCategory::class;
    }
}
