<?php

namespace App\Filament\Resources\LoanResource\RelationManagers;

use App\Enums\RadioStatusEnum;
use App\Filament\Resources\RadioResource\RadioResourceViewBuilder;
use App\Models\Radio;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
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
use Illuminate\Support\Facades\Log;

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
            columns: [TextColumn::make('state')->label('Loan State'),],
            headerActions: [
                CreateAction::make(),
                AttachAction::make()
                    ->recordTitleAttribute('identifier')
                    ->recordSelectOptionsQuery(fn($query) => $query->where('status', RadioStatusEnum::AVAILABLE))
                    ->preloadRecordSelect()
                    ->form(fn(AttachAction $action): array => [
                        Wizard::make([
                            Step::make('Attach Multiple')
                                ->schema([
                                    TextInput::make('from')
                                        ->label('Noleggia "Available" da')
                                        // Nota: questi campi non sono colonne reali del model,
                                        // li usi solo per filtrare la query.
                                        ->placeholder('Inserisci valore di partenza'),
                                    TextInput::make('to')
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
                    ])
                    ->after(function (AttachAction $action, array $data): void {
                        if (!empty($data['from']) && !empty($data['to'])) {
                            $from = $data['from'];
                            $to = $data['to'];
                            $radios = Radio::query()
                                ->whereBetween('identifier', [$from, $to])
                                ->where('status', RadioStatusEnum::AVAILABLE)
                                ->get();
                            Log::info($radios);
                            foreach ($radios as $radio) {
                                $action->getRecord()->radios()->attach($radio->id, [
                                    'state' => $data['state'],
                                ]);
                            }
                        } else {
                            $selectedRadios = $data['record_id'] ?? [];
                            if (empty($selectedRadios)) return;
                            $action->getRecord()->radios()->attach($selectedRadios, [
                                'state' => $data['state'],
                            ]);
                        }
                    })
            ],
            actions: [EditAction::make(), DetachAction::make()],
        );
    }
}
