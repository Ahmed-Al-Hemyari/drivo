<?php

namespace App\Filament\Resources\MoneyTransactions\Schemas;

use App\Filament\Resources\Bookings\BookingResource;
use App\Models\MoneyTransaction;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;

class MoneyTransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->components([
                        TextEntry::make('booking.title')
                            ->label(__('Booking'))
                            ->weight('bold')
                            ->size(TextSize::Medium)
                            ->url(fn($record) => BookingResource::getUrl('view', ['record' => $record->booking_id]))
                            ->color('primary'),
                        TextEntry::make('transaction_date')
                            ->label(__('Transaction Date'))
                            ->dateTime('Y-m-d h:i A')
                            ->weight('bold'),
                        TextEntry::make('notes')
                            ->label(__('Notes'))
                            ->size(TextSize::Medium),
                        TextEntry::make('amount')
                            ->label(__('Amount'))
                            ->weight(FontWeight::Bold),
                        TextEntry::make('transaction_type')
                            ->label(__('Transaction Type'))
                            ->formatStateUsing(fn (int $state): string => match ($state) {
                                0 => __('Income'),
                                1 => __('Expense'),
                            })
                            ->weight('bold'),
                        IconEntry::make('atm')
                            ->label(__('ATM'))
                            ->boolean(),
                    ]),
            ]);
    }
}
