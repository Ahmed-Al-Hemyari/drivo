<?php

namespace App\Filament\Resources\MoneyTransactions\Schemas;

use App\Models\Car;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class MoneyTransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->components([
                        Select::make('booking_id')
                            ->label(__('Booking'))
                            ->relationship(
                                name: 'booking',
                                titleAttribute: 'id',
                                modifyQueryUsing: fn ($query, ?Model $record) =>
                                    $query
                                        ->with(['user', 'car'])
                                        ->whereDoesntHave('review')
                                        ->when($record, fn ($q) =>
                                            $q->orWhere('id', $record->booking_id)
                                        )
                            )
                            ->getOptionLabelFromRecordUsing(fn ($record) => (string) $record->title)
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        DateTimePicker::make('transaction_date')
                            ->label(__('Transaction Date'))
                            ->default(now())
                            ->required(),
                        TextInput::make('amount')
                            ->label(__('Amount'))
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->step(0.01)
                            ->suffix('$'),
                        Select::make('transaction_type')
                            ->label(__('Transaction Type'))
                            ->options([
                                0 => __('Income'),
                                1 => __('Expense'),
                            ])
                            ->rules(['integer', 'in:0,1'])
                            ->required(),
                        Toggle::make('atm')
                            ->label(__('ATM'))
                            ->required(),
                        Textarea::make('notes')
                            ->label(__('Notes'))
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
