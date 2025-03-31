<?php

namespace App\Actions;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Loan;
use Illuminate\Support\Facades\Storage;

class CreatePdf
{
    static function createPdf(Loan $loan): bool
    {
        // Recupera le radio associate al loan
        $radios = $loan->radios;

        // Prepara i dati da passare alla view
        $data = [
            'loan'   => $loan,
            'radios' => $radios,
        ];

        // Genera l'HTML dalla view
        $html = view('pdf_template', $data)->render();

        // Crea il PDF utilizzando Dompdf
        $pdf = Pdf::loadHTML($html)->setPaper('A4', 'portrait');

        // Salva il PDF nel filesystem (es. cartella public/pdfs)
        $fileName = $loan->identifier . "_pdf" . '.pdf';
        $filePath = storage_path('app/public/' . $fileName);

        file_put_contents($filePath, $pdf->output());

        // Salva l'URL del PDF nel loan e aggiorna il record
        $loan->pdf_url = url('pdfs/' . $fileName);
        $loan->save();

        return true;
    }
}
