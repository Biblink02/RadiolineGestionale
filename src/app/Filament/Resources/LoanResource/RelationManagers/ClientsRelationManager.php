<?php

namespace App\Filament\Resources\LoanResource\RelationManagers;

use App\Filament\Resources\ClientResource\ClientResourceViewBuilder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;

class ClientsRelationManager extends RelationManager
{
    protected static string $relationship = 'clients';

    public function form(Form $form): Form
    {
        return ClientResourceViewBuilder::getForm($form);
    }

    public function table(Table $table): Table
    {
        return ClientResourceViewBuilder::getTable(
            $table,
            headerActions: [CreateAction::make(), AttachAction::make()],
            actions: [EditAction::make(),DetachAction::make()],
        );
    }
}
