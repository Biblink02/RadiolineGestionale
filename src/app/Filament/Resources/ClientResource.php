<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\ClientResourceViewBuilder;
use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers\DocumentsRelationManager;
use App\Filament\Resources\ClientResource\RelationManagers\LoansRelationManager;
use App\Models\Client;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return ClientResourceViewBuilder::getForm($form);
    }

    public static function table(Table $table): Table
    {
        return ClientResourceViewBuilder::getTable($table);
    }

    public static function getRelations(): array
    {
        return [
            DocumentsRelationManager::class,
            LoansRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
