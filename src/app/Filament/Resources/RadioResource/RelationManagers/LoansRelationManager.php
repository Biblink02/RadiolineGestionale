<?php

namespace App\Filament\Resources\RadioResource\RelationManagers;

use App\Filament\Resources\LoanResource\LoanResourceViewBuilder;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LoansRelationManager extends RelationManager
{
    protected static string $relationship = 'loans';

    public function form(Form $form): Form
    {
        return LoanResourceViewBuilder::getForm($form);
    }

    public function table(Table $table): Table
    {
        return LoanResourceViewBuilder::getTable(
            $table,
            headerActions: [
                CreateAction::make(),
                AttachAction::make()
                    ->recordTitleAttribute('id')
                    ->preloadRecordSelect()
                    ->form(fn (AttachAction $action): array => [
                        $action
                            ->getRecordSelect()
                            ->required(),
                    ])
            ],
            actions: [EditAction::make(), DetachAction::make()],
        );
    }
}
