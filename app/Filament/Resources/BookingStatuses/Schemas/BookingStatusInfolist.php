<?php

namespace App\Filament\Resources\BookingStatuses\Schemas;

use App\Models\BookingStatus;
use Filament\Infolists\Components\ColorEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

class BookingStatusInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->components([
                        TextEntry::make('name_en')
                            ->label(__('English Name'))
                            ->weight('bold')
                            ->size(TextSize::Medium),
                        TextEntry::make('name_ar')
                            ->label(__('Arabic Name'))
                            ->weight('bold')
                            ->size(TextSize::Medium),
                        ColorEntry::make('background_color')
                            ->label(__('Background Color')),
                        ColorEntry::make('font_color')
                            ->label(__('Font Color')),
                        TextEntry::make('name_' . app()->getLocale())
                            ->label(__('Preview'))
                            ->formatStateUsing(function ($state, $record) {
                                $bg = $record->background_color ?? '#6B7280';
                                $color = $record->font_color ?? '#FFFFFF';

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
                    ])
            ]);
    }
}
