<?php

namespace App\Filament\Resources\BookingStatuses\Pages;

use App\Filament\Resources\BookingStatuses\BookingStatusResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBookingStatus extends EditRecord
{
    protected static string $resource = BookingStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
