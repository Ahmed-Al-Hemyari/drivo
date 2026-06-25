<?php

namespace App\Filament\Resources\Bookings\Tables;

use App\Filament\Resources\Cars\CarResource;
use App\Filament\Resources\Users\UsersResource;
use App\Models\Car;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\IconSize;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('car.full_name')
                    ->label(__('Car'))
                    ->url(fn($record) => CarResource::getUrl('view', ['record' => $record->car_id]))
                    ->color('primary')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label(__('User'))
                    ->url(fn($record) => UsersResource::getUrl('view', ['record' => $record->user_id]))
                    ->color('primary')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('start_date')
                    ->label(__('Start Date'))
                    ->dateTime('Y-m-d h:i A')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('end_date')
                    ->label(__('End Date'))
                    ->dateTime('Y-m-d h:i A')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('duration')
                    ->label(__('Duration'))
                    ->formatStateUsing(function ($state, $record) {
                        return $state . " " . __('Days');
                    })
                    ->sortable()
                    ->searchable(),

                IconColumn::make('rated')
                    ->label(__('Rated'))
                    ->alignCenter()
                    ->sortable()
                    ->boolean(),
                TextColumn::make('bookingStatus.name_' . app()->getLocale())
                    ->searchable()
                    ->label(__('Booking Status'))
                    ->sortable()
                    ->alignCenter()
                    ->formatStateUsing(function ($state, $record) {
                        $bg = $record->bookingStatus?->background_color ?? '#6B7280';
                        $color = $record->bookingStatus?->font_color ?? '#FFFFFF';

                        return new \Illuminate\Support\HtmlString(
                            "<span style='
                                background-color: {$bg};
                                color: {$color};
                                padding: 4px 20px;
                                border-radius: 9999px;
                                font-size: 12px;
                                font-weight: 700;
                                display: inline-block;
                            '>{$state}</span>"
                        );
                    })
                    ->html(),
                TextColumn::make('amount')
                    ->label(__('Amount'))
                    ->weight(FontWeight::Bold)
                    ->alignCenter(),
                TextColumn::make('vat')
                    ->label(__('VAT'))
                    ->weight(FontWeight::Bold)
                    ->alignCenter(),
                TextColumn::make('total_amount_with_vat')
                    ->label(__('Total Amount With VAT'))
                    ->weight(FontWeight::Bold)
                    ->alignCenter(),
                TextColumn::make('total_paid')
                    ->label(__('Total Paid'))
                    ->color('success')
                    ->weight(FontWeight::Bold)
                    ->alignCenter(),
                TextColumn::make('total_remaining')
                    ->label(__('Total Remaining'))
                    ->color('danger')
                    ->weight(FontWeight::Bold)
                    ->alignCenter(),
            ])
            ->filters([
                SelectFilter::make('car_id')
                    ->label(__('Car'))
                    ->relationship(
                        name: 'car',
                        titleAttribute: 'name_' . app()->getLocale(),
                        modifyQueryUsing: fn (Builder $query) => $query->with('brand')
                    )
                    ->getOptionLabelFromRecordUsing(fn (Car $record) => $record->full_name)
                    ->searchable()
                    ->preload(),
                SelectFilter::make('user_id')
                    ->label(__('User'))
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('booking_status_id')
                    ->label(__('Booking Status'))
                    ->relationship('bookingStatus', 'name_' . app()->getLocale())
                    ->searchable()
                    ->preload(),
                Filter::make('rated')
                    ->label(__('Rated'))
                    ->toggle()
                    ->query(fn (Builder $query) => $query->where('rated', true)),
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
                    BulkAction::make('confirm')
                        ->label(__('Confirm Bookings'))
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->booking_status_id = 2;
                                $record->save();
                            }
                        })
                        ->color('blue'),
                        BulkAction::make('complete')
                            ->label(__('Update to Completed'))
                            ->action(function ($records) {
                                foreach ($records as $record) {
                                    $record->booking_status_id = 7;
                                    $record->save();
                                    }
                            })
                            ->color('success'),
                    BulkAction::make('refuse')
                        ->label(__('Refuse Bookings'))
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->booking_status_id = 4;
                                $record->save();
                            }
                        })
                        ->color('danger'),
                    BulkAction::make('cancel')
                        ->label(__('Cancel Bookings'))
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->booking_status_id = 3;
                                $record->save();
                            }
                        })
                        ->color('danger'),
                    // DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
