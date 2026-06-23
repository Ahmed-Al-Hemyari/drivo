<?php

namespace App\Filament\Resources\BookingStatuses;

use App\Filament\Resources\BookingStatuses\Pages\CreateBookingStatus;
use App\Filament\Resources\BookingStatuses\Pages\EditBookingStatus;
use App\Filament\Resources\BookingStatuses\Pages\ListBookingStatuses;
use App\Filament\Resources\BookingStatuses\Pages\ViewBookingStatus;
use App\Filament\Resources\BookingStatuses\RelationManagers\BookingsRelationManager;
use App\Filament\Resources\BookingStatuses\Schemas\BookingStatusForm;
use App\Filament\Resources\BookingStatuses\Schemas\BookingStatusInfolist;
use App\Filament\Resources\BookingStatuses\Tables\BookingStatusesTable;
use App\Models\BookingStatus;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingStatusResource extends Resource
{
    protected static ?string $model = BookingStatus::class;

    public static function getModelLabel(): string
    {
        return __('Booking Status');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Booking Statuses');
    }

    public static function getNavigationLabel(): string
    {
        return __('Booking Statuses');
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckBadge;
    protected static string|UnitEnum|null $navigationGroup = null;
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('Settings');
    }

    public static function form(Schema $schema): Schema
    {
        return BookingStatusForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BookingStatusInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BookingStatusesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            BookingsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBookingStatuses::route('/'),
            'create' => CreateBookingStatus::route('/create'),
            'view' => ViewBookingStatus::route('/{record}'),
            'edit' => EditBookingStatus::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
