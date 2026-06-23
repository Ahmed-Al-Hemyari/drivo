<?php

namespace App\Filament\Resources\BookingStatuses\Pages;

use App\Filament\Resources\BookingStatuses\BookingStatusResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBookingStatus extends ViewRecord
{
    protected static string $resource = BookingStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make(),
        ];
    }
}
