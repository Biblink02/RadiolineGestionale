<?php

namespace App\Actions\Custom;

use App\Models\Loan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CreatePdf
{
    static function createPdf(Loan $loan): void
    {
        // Prepara i dati da passare alla view
        $data = [
            'loan' => $loan,
            'radios' => $loan->radios()->orderBy('identifier')->get(),
        ];

        // Genera l'HTML dalla view
        $html = view('pdf_template', $data)->render();

        // Crea il PDF utilizzando Dompdf
        $pdf = Pdf::loadHTML($html)->setPaper('A4', 'portrait');

        // STEP 2: Elimina il PDF precedente se esiste (salvato in pdf_url)
        if(!empty($loan->pdf_url)) {
            Log::info("PDF created at {$loan->pdf_url}");
            Storage::disk('public')->delete($loan->pdf_url);
        }

        // STEP 3: Genera il nuovo nome e salva il PDF nel filesystem
        $fileName = self::getFileName($loan);
        $filePath = storage_path('app/public/' . $fileName);

        file_put_contents($filePath, $pdf->output());

        // STEP 4: Aggiorna il campo pdf_url nel record del loan
        $loan->pdf_url = $fileName;

        // Imposta la data se non è già presente
        if (empty($loan->date)) {
            $loan->date = now();
        }

        $loan->save();
    }

    private static function getFileName(Loan $loan): string
    {
        // Nome base con ID del loan
        $baseName = 'loan_' . $loan->id;
        $fileName = $baseName . '.pdf';

        // Controlla se esiste già nel filesystem
        if (Storage::disk('public')->exists($fileName)) {
            // Se esiste, aggiungi timestamp per renderlo unico
            $timestamp = now()->format('Y-m-d_H:i:s');
            $fileName = $baseName . '_' . $timestamp . '.pdf';
        }

        return $fileName;
    }

}
