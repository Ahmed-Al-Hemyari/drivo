<?php

namespace App\Filament\Resources\BookingStatuses\Pages;

use App\Filament\Resources\BookingStatuses\BookingStatusResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBookingStatus extends CreateRecord
{
    protected static string $resource = BookingStatusResource::class;
}
