<?php

namespace App\Filament\Resources\LoanResource\RelationManagers;

use App\Enums\RadioStatusEnum;
use App\Filament\Resources\RadioResource\RadioResourceViewBuilder;
use App\Models\Radio;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;

class RadiosRelationManager extends RelationManager
{
    protected static string $relationship = 'radios';

    public function form(Form $form): Form
    {
        return RadioResourceViewBuilder::getForm($form);
    }

    public function table(Table $table): Table
    {
        return RadioResourceViewBuilder::getTable(
            $table,
            headerActions: [
                CreateAction::make(),
                AttachAction::make()
                    ->recordTitleAttribute('identifier')
                    ->recordSelectOptionsQuery(fn ($query) => $query->where('status', RadioStatusEnum::AVAILABLE))
                    ->preloadRecordSelect()
                    ->form(fn (AttachAction $action): array => [
                        Wizard::make([
                            Step::make('Attach multiple')
                                ->schema([
                                    Grid::make()
                                        ->schema([
                                            TextInput::make('number1')
                                                ->label('Radio già collegate:')
                                                ->disabled()
                                                ->dehydrated(false)
                                                ->default($this->getOwnerRecord()?->radios()->count() ?? 0)
                                                ->columnSpan(1),

                                            TextInput::make('number2')
                                                ->label('Radio ora inserite:')
                                                ->disabled()
                                                ->dehydrated(false)
                                                ->reactive()
                                                ->default(0)
                                                ->columnSpan(1),

                                            Textarea::make('multiple')
                                                ->label('Noleggia radio:')
                                                ->placeholder('Inserisci id radio e vai a capo')
                                                ->reactive()
                                                ->afterStateUpdated(function (callable $set, $state) {
                                                    $lines = preg_split('/\R/', $state ?? '');
                                                    $filtered = array_unique(array_filter(array_map('trim', $lines), fn ($line) => $line !== ''));
                                                    $set('number2', count($filtered)); // <- nota: "number2" era sbagliato prima
                                                })
                                                ->rows(10)
                                                ->debounce(1000)
                                                ->columnSpanFull(), // textarea su tutta la larghezza
                                        ]),
                                ]),
                            Step::make('Attach on interval')
                                ->schema([
                                    TextInput::make('from')
                                        ->requiredWith('to')
                                        ->label('Noleggia "Available" da')
                                        // Nota: questi campi non sono colonne reali del model,
                                        // li usi solo per filtrare la query.
                                        ->placeholder('Inserisci valore di partenza'),
                                    TextInput::make('to')
                                        ->requiredWith('from')
                                        ->label('Noleggia "Available" a')
                                        ->placeholder('Inserisci valore di fine'),
                                ]),
                            Step::make('Attach One')
                                ->schema([
                                    $action->getRecordSelect()
                                        ->searchable()
                                        ->multiple()
                                        ->required(false)
                                        ->label('Radio'),
                                ]),
                        ])
                            ->skippable()
                            ->previousAction(fn ($action) => $action->extraAttributes(['x-show' => 'false']))
                            ->nextAction(fn ($action) => $action->extraAttributes(['x-show' => 'false'])),
                    ])
                    ->modalWidth('3xl')
                    ->action(function (AttachAction $action, array $data): void {
                        $identifiers = array_filter(
                            array_map('trim', preg_split('/\R/', $data['multiple'] ?? '')),
                            fn ($identifier) => $identifier !== '',
                        );

                        $radioIds = Radio::query()
                            ->whereIn('identifier', $identifiers)
                            ->orWhereIn('id', $data['recordId'] ?? [])
                            ->when(filled($data['from'] ?? null) && filled($data['to'] ?? null),
                                fn ($query) => $query->orWhereBetween('identifier', [$data['from'], $data['to']]))
                            ->pluck('id')
                            ->all();

                        $this->getOwnerRecord()->attachAvailableRadios($radioIds);
                        $action->success();
                    }),

            ],
            actions: [EditAction::make(), DetachAction::make()],
        );
    }
}
