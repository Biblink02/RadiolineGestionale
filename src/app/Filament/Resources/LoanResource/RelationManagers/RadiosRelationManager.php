<?php

namespace App\Filament\Resources\LoanResource\RelationManagers;

use App\Enums\LoanStatusEnum;
use App\Enums\RadioStatusEnum;
use App\Filament\Resources\RadioResource\RadioResourceViewBuilder;
use App\Models\Radio;
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
            headerActions: [
                CreateAction::make(),
                AttachAction::make()
                    ->recordTitleAttribute('identifier')
                    ->recordSelectOptionsQuery(fn($query) => $query->where('status', RadioStatusEnum::AVAILABLE))
                    ->preloadRecordSelect()
                    ->form(fn(AttachAction $action): array => [
                        Wizard::make([
                            Step::make('Attach multiple')
                                ->schema([
                                    Textarea::make('multiple')
                                        ->label('Noleggia radio:')
                                        // Nota: questi campi non sono colonne reali del model,
                                        // li usi solo per filtrare la query.
                                        ->placeholder('Inserisci id radio e vai a capo'),
                                ]),
                            Step::make('Attach on interval')
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

                        // --- 1. Aggiungo le radio dalla textarea
                        $selectMultipleRadios = explode("\n", $data['multiple'] ?? "");
                        if (!empty($selectMultipleRadios)) {
                            $this->attachRadios($selectMultipleRadios);
                        }

                        // --- 2. Processa l'intervallo da/to ---
                        if (!empty($data['from']) && !empty($data['to'])) {
                            $this->attachRadiosByRange($data['from'], $data['to']);
                        }

                        // --- 3. Aggiungi radio singole ---
                        if (!empty($data['recordId'])) {
                            $this->attachSingleRadio($data['recordId']);
                        }
                    })

            ],
            actions: [EditAction::make(), DetachAction::make()],
        );
    }

    /**
     * Attacca le radio non già attaccate e le mantiene come AVAILABLE.
     *
     * @param array $radiosId
     */
    private function attachRadios(array $radiosId): void
    {
        // Pre-carica gli ID delle radio già attachate in un'unica query
        $attachedRadioIds = $this->ownerRecord->radios()->pluck('radio_id')->toArray();
        $radios = Radio::query()
            ->whereIn("identifier", $radiosId)
            ->get();

        foreach ($radios as $radio) {
            // Controlla in memoria se la radio non è già presente
            if (!in_array($radio->id, $attachedRadioIds)) {
                $this->ownerRecord->radios()->attach($radio->id);
                // Aggiorna l'array per evitare duplicazioni nel ciclo
                $attachedRadioIds[] = $radio->id;
            }
        }
    }

    /**
     * Attacca le radio non già attaccate nell'intervallo e le mantiene come AVAILABLE.
     *
     * @param string $from
     * @param string $to
     */
    private function attachRadiosByRange(string $from, string $to): void
    {
        // Pre-carica gli ID delle radio già attachate in un'unica query
        $attachedRadioIds = $this->ownerRecord->radios()->pluck('radio_id')->toArray();

        $radios = Radio::query()
            ->whereBetween('identifier', [$from, $to])
            ->where('status', RadioStatusEnum::AVAILABLE)
            ->get();

        foreach ($radios as $radio) {
            // Controlla in memoria se la radio non è già presente
            if (!in_array($radio->id, $attachedRadioIds)) {
                $this->ownerRecord->radios()->attach($radio->id);
                // Aggiorna l'array per evitare duplicazioni nel ciclo
                $attachedRadioIds[] = $radio->id;
            }
        }
    }

    /**
     * Attacca una singola radio e la mantiene come AVAILABLE.
     *
     * @param array $radioId
     */
    private function attachSingleRadio(array $radioId): void
    {
        // Pre-carica gli ID delle radio già attachate in un'unica query
        $attachedRadioIds = $this->ownerRecord->radios()->pluck('radio_id')->toArray();

        $radio = Radio::find($radioId);

        if ($radio && !in_array($radio->id, $attachedRadioIds)) {
            $this->ownerRecord->radios()->attach($radio->id);
        }
    }
}
