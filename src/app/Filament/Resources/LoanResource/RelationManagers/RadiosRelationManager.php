<?php

namespace App\Filament\Resources\LoanResource\RelationManagers;

use App\Enums\LoanStatusEnum;
use App\Enums\RadioStatusEnum;
use App\Filament\Resources\RadioResource\RadioResourceViewBuilder;
use App\Models\Radio;
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
                        // Determina se l'ownerRecord è attivo.
                        // TODO guarda loan date?
                        $isActive = $this->ownerRecord->status === LoanStatusEnum::ACTIVE->value;

                        // --- 1. Aggiorna lo stato delle radio già attachate (manualmente) ---
                        $selectedRadios = $data['recordId'] ?? [];
                        if (!empty($selectedRadios) && $isActive) {
                            $this->updateSelectedRadiosStatus($selectedRadios);
                        }

                        // --- 2. Processa l'intervallo da/to ---
                        if (!empty($data['from']) && !empty($data['to'])) {
                            $this->attachAndUpdateRadiosByRange($data['from'], $data['to'], $isActive);
                        }
                    })

            ],
            actions: [EditAction::make(), DetachAction::make()],
        );
    }

    /**
     * Aggiorna lo stato a LOANED per le radio già attachate manualmente.
     *
     * @param array $selectedRadioIds
     */
    private function updateSelectedRadiosStatus(array $selectedRadioIds): void
    {
        foreach ($selectedRadioIds as $radioId) {
            $radio = Radio::find($radioId);
            if ($radio && $radio->status === RadioStatusEnum::AVAILABLE->value) {
                $radio->status = RadioStatusEnum::LOANED;
                $radio->save();
            }
        }
    }

    /**
     * Attacca le radio non gia attaccate nell'intervallo e, se l'ownerRecord è attivo, aggiorna lo stato a LOANED.
     *
     * @param string $from
     * @param string $to
     * @param bool $isActive
     */
    private function attachAndUpdateRadiosByRange(string $from, string $to, bool $isActive): void
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
            if ($isActive && $radio->status === RadioStatusEnum::AVAILABLE->value) {
                $radio->status = RadioStatusEnum::LOANED;
                $radio->save();
            }
        }
    }

}
