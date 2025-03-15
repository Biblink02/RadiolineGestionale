<?php

namespace App\Filament\Resources\LoanResource\RelationManagers;

use App\Enums\LoanRadioStateEnum;
use App\Enums\RadioStatusEnum;
use App\Filament\Resources\RadioResource\RadioResourceViewBuilder;
use App\Models\Radio;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RadiosRelationManager extends RelationManager
{
    protected static string $relationship = 'radios';

    public function form(Form $form): Form
    {
        return RadioResourceViewBuilder::getForm($form, fields: [
            Select::make('state')
                ->label('Loan State')
                ->options(LoanRadioStateEnum::class)
                ->default(LoanRadioStateEnum::LOANED)
        ]);
    }

    public function table(Table $table): Table
    {
        return RadioResourceViewBuilder::getTable(
            $table,
            columns: [TextColumn::make('state')->label('Loan State'),],
            headerActions: [
                CreateAction::make(),
                AttachAction::make()
                    ->recordTitleAttribute('identifier')
                    ->recordSelectOptionsQuery(fn ($query) => $query->where('status', RadioStatusEnum::AVAILABLE))
                    ->preloadRecordSelect()
                    ->form(fn (AttachAction $action): array => [
                        $action
                            ->getRecordSelect()
                            ->searchable()
                            ->required(),
                        Select::make('state')
                            ->label('Loan State')
                            ->options(LoanRadioStateEnum::class)
                            ->default(LoanRadioStateEnum::LOANED),
                    ])

            ],
            actions: [EditAction::make(), DetachAction::make()],
        );
    }
}
