<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RadioResource\Pages;
use App\Filament\Resources\RadioResource\RadioResourceViewBuilder;
use App\Filament\Resources\RadioResource\RelationManagers;
use App\Models\Radio;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class RadioResource extends Resource
{
    protected static ?string $model = Radio::class;

    protected static ?string $navigationIcon = 'heroicon-o-radio';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return RadioResourceViewBuilder::getForm($form);
    }

    public static function table(Table $table): Table
    {
        return RadioResourceViewBuilder::getTable($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\LoansRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRadios::route('/'),
            'create' => Pages\CreateRadio::route('/create'),
            'edit' => Pages\EditRadio::route('/{record}/edit'),
        ];
    }
}
