<?php

namespace App\Filament\Resources\MoneyTransactions\Pages;

use App\Filament\Resources\MoneyTransactions\MoneyTransactionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMoneyTransactions extends ListRecords
{
    protected static string $resource = MoneyTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
