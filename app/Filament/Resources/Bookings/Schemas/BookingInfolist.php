<?php

namespace App\Filament\Resources\Bookings\Schemas;

use App\Filament\Resources\Cars\CarResource;
use App\Filament\Resources\Users\UsersResource;
use App\Models\Booking;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;

class BookingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->components([
                        TextEntry::make('user.name')
                            ->label(__('User'))
                            ->weight('bold')
                            ->size(TextSize::Medium)
                            ->url(fn($record) => UsersResource::getUrl('view', ['record' => $record->user_id]))
                            ->color('primary'),
                        TextEntry::make('car.full_name')
                            ->label(__('Car'))
                            ->weight('bold')
                            ->size(TextSize::Medium)
                            ->url(fn($record) => CarResource::getUrl('view', ['record' => $record->car_id]))
                            ->color('primary'),
                        TextEntry::make('start_date')
                            ->label(__('Start Date'))
                            ->dateTime('Y-m-d h:i A')
                            ->weight('bold'),
                        TextEntry::make('end_date')
                            ->label(__('End Date'))
                            ->dateTime('Y-m-d h:i A')
                            ->weight('bold'),
                        TextEntry::make('duration')
                            ->label(__('Duration'))
                            ->formatStateUsing(function ($state, $record) {
                                return $state . " " . __('Days');
                            })
                            ->weight('bold'),
                        TextEntry::make('bookingStatus.name_' . app()->getLocale())
                            ->label(__('Booking Status'))
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
                        TextEntry::make('total_amount')
                            ->label(__('Total Amount'))
                            // ->color('success')
                            ->weight(FontWeight::Bold),
                        TextEntry::make('total_paid')
                            ->label(__('Total Paid'))
                            ->color('success')
                            ->weight(FontWeight::Bold),
                        TextEntry::make('total_remaining')
                            ->label(__('Total Remaining'))
                            ->color('danger')
                            ->weight(FontWeight::Bold),
                    ]),
            ]);
    }
}
