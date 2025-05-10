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
        if (empty($loan->loan_date)) {
            $loan->loan_date = now();
        }
        $loan->save();
    }


    static private function getFileName(Loan $loan): string
    {
        $clients = $loan->clients()->get();
        $hasClients = !$clients->isEmpty();
        $hasIdentifier = !empty($loan->identifier);

        // Se sia clients che identifier sono vuoti, genera un nome casuale
        if (!$hasClients && !$hasIdentifier) {
            return str_replace(' ', '_', 'loan_' . now() . '.pdf');
        }

        $nameParts = [];

        // Aggiunge il nome dei client se presenti
        if ($hasClients) {
            foreach ($clients as $client) {
                // Se first_name o last_name sono null, verranno trattati come stringa vuota
                $firstName = $client->name ?? '';
                $lastName = $client->surname ?? '';
                // Solo se almeno uno dei due è valorizzato
                if ($firstName !== '' || $lastName !== '') {
                    $nameParts[] = trim($firstName . '_' . $lastName, '_');
                }
            }
        }

        // Aggiunge l'identifier se presente
        if ($hasIdentifier) {
            $nameParts[] = $loan->identifier;
        }

        $name = implode('_', $nameParts);
        return $name . '.pdf';
    }

}
