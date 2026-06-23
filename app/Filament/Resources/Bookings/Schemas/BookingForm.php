<?php

namespace App\Filament\Resources\Bookings\Schemas;

use App\Models\Car;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->components([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label(__('User'))
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('car_id')
                            ->label(__('Car'))
                            ->relationship(
                                name: 'car',
                                titleAttribute: 'name_' . app()->getLocale(),
                                modifyQueryUsing: fn (Builder $query) => $query->with('brand')
                            )
                            ->getOptionLabelFromRecordUsing(fn (Car $record) => $record->full_name)
                            ->searchable()
                            ->preload()
                            ->live()
                            ->required(),
                        DateTimePicker::make('start_date')
                            ->label(__('Start Date'))
                            ->native(false)
                            ->disabledDates(function ($get) {
                                $carId = $get('car_id');
                                return $carId ? (Car::find($carId)?->unavailable_dates ?? []) : [];
                            })
                            ->required(),
                        DateTimePicker::make('end_date')
                            ->label(__('End Date'))
                            ->native(false)
                            ->after('start_date')
                            ->disabledDates(function ($get) {
                                $carId = $get('car_id');
                                return $carId ? (Car::find($carId)?->unavailable_dates ?? []) : [];
                            })
                            // fix overlapping
                            ->rules(fn ($get, $record): array => [
                                function (string $attribute, $value, \Closure $fail) use ($get, $record) {
                                    $startDate = $get('start_date');
                                    $endDate = $value;
                                    $carId = $get('car_id');
                                    if (! $startDate || ! $endDate || ! $carId) {
                                        return;
                                    }

                                    $hasOverlap = \App\Models\Booking::where('car_id', $carId)
                                        ->whereIn('status', ['pending', 'confirmed', 'active'])
                                        ->where('start_date', '<=', $endDate)
                                        ->where('end_date', '>=', $startDate)
                                        ->when($record, fn ($query) => $query->where('id', '!=', $record->id))
                                        ->exists();

                                    if ($hasOverlap) {
                                        $fail(__('The selected period overlaps with an existing booking for this car.'));
                                    }
                                },
                            ])
                            ->required(),
                        Select::make('booking_status_id')
                            ->relationship(
                                name: 'bookingStatus',
                                titleAttribute: 'name_' . app()->getLocale(),
                            )
                            ->label(__('Booking Status'))
                            ->searchable()
                            ->preload()
                            ->required(),
                        Textarea::make('notes')
                            ->label(__('Notes'))
                            ->nullable(),
                    ]),
            ]);
    }
}
