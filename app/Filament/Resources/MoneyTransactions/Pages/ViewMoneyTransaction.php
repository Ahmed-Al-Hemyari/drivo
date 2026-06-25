<?php

namespace App\Filament\Resources\MoneyTransactions\Pages;

use App\Filament\Resources\MoneyTransactions\MoneyTransactionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMoneyTransaction extends ViewRecord
{
    protected static string $resource = MoneyTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make(),
        ];
    }
}
