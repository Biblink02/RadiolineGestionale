<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\DocumentResourceViewBuilder;
use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Document;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return DocumentResourceViewBuilder::getForm($form);
    }

    public static function table(Table $table): Table
    {
        return DocumentResourceViewBuilder::getTable($table);
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
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
