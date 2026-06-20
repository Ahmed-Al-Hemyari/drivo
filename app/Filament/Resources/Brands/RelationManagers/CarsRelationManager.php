<?php

namespace App\Filament\Resources\Brands\RelationManagers;

use App\Filament\Resources\Brands\Pages\EditBrand;
use App\Filament\Resources\Cars\CarResource;
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
        return $pageClass !== EditBrand::class;
    }
}
