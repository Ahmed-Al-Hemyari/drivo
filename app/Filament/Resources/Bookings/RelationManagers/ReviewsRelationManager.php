<?php

namespace App\Filament\Resources\Bookings\RelationManagers;

use App\Filament\Resources\Bookings\Pages\EditBooking;
use App\Filament\Resources\Reviews\ReviewResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ReviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'review';

    protected static ?string $relatedResource = ReviewResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make()
                    ->hidden(fn ($livewire) => $livewire->getOwnerRecord()->review()->exists()),
            ]);
    }

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        return $pageClass !== EditBooking::class;
    }
}
