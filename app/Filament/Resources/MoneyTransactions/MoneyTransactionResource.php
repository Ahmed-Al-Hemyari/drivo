<?php

namespace App\Filament\Resources\MoneyTransactions;

use App\Filament\Resources\MoneyTransactions\Pages\CreateMoneyTransaction;
use App\Filament\Resources\MoneyTransactions\Pages\EditMoneyTransaction;
use App\Filament\Resources\MoneyTransactions\Pages\ListMoneyTransactions;
use App\Filament\Resources\MoneyTransactions\Pages\ViewMoneyTransaction;
use App\Filament\Resources\MoneyTransactions\Schemas\MoneyTransactionForm;
use App\Filament\Resources\MoneyTransactions\Schemas\MoneyTransactionInfolist;
use App\Filament\Resources\MoneyTransactions\Tables\MoneyTransactionsTable;
use App\Models\MoneyTransaction;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class MoneyTransactionResource extends Resource
{
    protected static ?string $model = MoneyTransaction::class;

    public static function getModelLabel(): string
    {
        return __('Money Transaction');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Money Transactions');
    }

    public static function getNavigationLabel(): string
    {
        return __('Money Transactions');
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;
    protected static string|UnitEnum|null $navigationGroup = null;
    protected static ?int $navigationSort = 8;

    public static function getNavigationGroup(): ?string
    {
        return __('General Management');
    }

    public static function form(Schema $schema): Schema
    {
        return MoneyTransactionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MoneyTransactionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MoneyTransactionsTable::configure($table);
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
            'index' => ListMoneyTransactions::route('/'),
            'create' => CreateMoneyTransaction::route('/create'),
            'view' => ViewMoneyTransaction::route('/{record}'),
            'edit' => EditMoneyTransaction::route('/{record}/edit'),
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
