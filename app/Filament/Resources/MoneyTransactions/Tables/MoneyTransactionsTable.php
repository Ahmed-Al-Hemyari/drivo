<?php

namespace App\Filament\Resources\MoneyTransactions\Tables;

use App\Filament\Resources\Bookings\BookingResource;
use App\Models\Booking;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\IconSize;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MoneyTransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking.title')
                    ->label(__('Booking'))
                    ->url(fn($record) => $record->booking_id
                        ? BookingResource::getUrl('view', ['record' => $record->booking_id])
                        : null
                    )
                    ->color(fn($record) => $record->booking_id ? 'primary' : 'gray')
                    ->default('-')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('transaction_date')
                    ->label(__('Transaction Date'))
                    ->dateTime('Y-m-d h:i A')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('amount')
                    ->label(__('Amount'))
                    ->formatStateUsing(function ($state) {
                        return $state . ' $';
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('transaction_type')
                    ->label(__('Transaction Type'))
                    ->formatStateUsing(fn (int $state): string => match ($state) {
                        0 => __('Income'),
                        1 => __('Expense'),
                    })
                    ->sortable(),
                IconColumn::make('atm')
                    ->label(__('ATM'))
                    ->boolean(),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->with(['booking.user', 'booking.car']))
            ->filters([
                SelectFilter::make('booking_id')
                    ->label(__('Booking'))
                    ->relationship(
                        name: 'booking',
                        titleAttribute: 'id',
                        modifyQueryUsing: fn (Builder $query) => $query->with(['user', 'car'])
                    )
                    ->getOptionLabelFromRecordUsing(fn (Booking $record) => $record->title)
                    ->searchable()
                    ->preload(),
                SelectFilter::make('transaction_type')
                    ->label(__('Transaction Type'))
                    ->options([
                        0 => __('Income'),
                        1 => __('Expense'),
                    ]),
                TrashedFilter::make(),
            ])
            ->recordActions([
                ReplicateAction::make()
                    ->color('gray')
                    ->iconSize(IconSize::Medium)
                    ->tooltip(__('Replicate'))
                    ->label(''),
                ViewAction::make()
                    ->iconSize(IconSize::Medium)
                    ->color('gray')
                    ->tooltip(__('View'))
                    ->label(''),
                EditAction::make()
                    ->iconSize(IconSize::Medium)
                    ->color('gray')
                    ->tooltip(__('Edit'))
                    ->label(''),
                DeleteAction::make()
                    ->iconSize(IconSize::Medium)
                    ->tooltip(__('Delete'))
                    ->label('')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
