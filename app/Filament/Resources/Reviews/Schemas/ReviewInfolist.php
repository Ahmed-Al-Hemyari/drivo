<?php

namespace App\Filament\Resources\Reviews\Schemas;

use App\Filament\Resources\Bookings\BookingResource;
use App\Models\Review;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

class ReviewInfolist
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
                        TextEntry::make('rate')
                            ->label(__('Rate'))
                            ->weight('bold')
                            ->size(TextSize::Medium),
                        TextEntry::make('comment')
                            ->label(__('Comment'))
                            ->weight('bold')
                            ->size(TextSize::Medium)
                            ->placeholder('-'),
                    ])
            ]);
    }
}
