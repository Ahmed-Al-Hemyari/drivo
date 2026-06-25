<?php

namespace App\Filament\Resources\MoneyTransactions\Pages;

use App\Filament\Resources\MoneyTransactions\MoneyTransactionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMoneyTransaction extends CreateRecord
{
    protected static string $resource = MoneyTransactionResource::class;
}
