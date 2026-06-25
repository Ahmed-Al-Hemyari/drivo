<?php

namespace App\Filament\Resources\GeneralSettings;

use App\Filament\Resources\GeneralSettings\Pages\CreateGeneralSetting;
use App\Filament\Resources\GeneralSettings\Pages\EditGeneralSetting;
use App\Filament\Resources\GeneralSettings\Pages\ListGeneralSettings;
use App\Filament\Resources\GeneralSettings\Pages\ViewGeneralSetting;
use App\Filament\Resources\GeneralSettings\Schemas\GeneralSettingForm;
use App\Filament\Resources\GeneralSettings\Schemas\GeneralSettingInfolist;
use App\Filament\Resources\GeneralSettings\Tables\GeneralSettingsTable;
use App\Models\GeneralSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class GeneralSettingResource extends Resource
{
    protected static ?string $model = GeneralSetting::class;

     public static function getModelLabel(): string
    {
        return __('General Settings');
    }

    public static function getPluralModelLabel(): string
    {
        return __('General Settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('General Settings');
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckBadge;
    protected static string|UnitEnum|null $navigationGroup = null;
    protected static ?int $navigationSort = 4;

    public static function getNavigationGroup(): ?string
    {
        return __('Settings');
    }

    public static function form(Schema $schema): Schema
    {
        return GeneralSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GeneralSettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGeneralSettings::route('/'),
            'create' => CreateGeneralSetting::route('/create'),
            'view' => ViewGeneralSetting::route('/{record}'),
            'edit' => EditGeneralSetting::route('/{record}/edit'),
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
