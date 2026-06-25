<?php

namespace App\Filament\Resources\GeneralSettings\Pages;

use App\Filament\Resources\GeneralSettings\GeneralSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewGeneralSetting extends ViewRecord
{
    protected static string $resource = GeneralSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make(),
        ];
    }
}
