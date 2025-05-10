<?php

namespace App\Filament\Resources\LoanResource\Pages;

use App\Enums\RadioStatusEnum;
use App\Filament\Resources\LoanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLoan extends EditRecord
{
    protected static string $resource = LoanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function afterSave(): void
    {
        // Se 'returned_at' è stato settato, imposta a 'available' solo le radio nella relazione che sono 'loaned'
        if (!empty($this->record->returned_at)) {
            $this->record->radios()
                ->where('status', RadioStatusEnum::LOANED->value)
                ->update(['status' => RadioStatusEnum::AVAILABLE->value]);
        }
    }
}
