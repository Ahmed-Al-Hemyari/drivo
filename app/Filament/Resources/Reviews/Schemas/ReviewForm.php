<?php

namespace App\Filament\Resources\Reviews\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class ReviewForm
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
                            ->required(),
                        TextInput::make('rate')
                            ->label(__('Rate'))
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->maxValue(5)
                            ->step(0.5),
                        Textarea::make('comment')
                            ->label(__('Comment')),
                    ]),
            ]);
    }
}
