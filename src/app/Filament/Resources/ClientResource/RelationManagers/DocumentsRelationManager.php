<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use App\Filament\Resources\DocumentResource\DocumentResourceViewBuilder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    public function form(Form $form): Form
    {
        return DocumentResourceViewBuilder::getForm($form);
    }

    public function table(Table $table): Table
    {
        return DocumentResourceViewBuilder::getTable(
            $table,
            headerActions: [CreateAction::make(), AttachAction::make()],
            actions: [EditAction::make(),DetachAction::make()],
        );
    }
}
