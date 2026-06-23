<?php

namespace App\Filament\Resources\BookingStatuses\Pages;

use App\Filament\Resources\BookingStatuses\BookingStatusResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBookingStatuses extends ListRecords
{
    protected static string $resource = BookingStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
