<?php

namespace App\Actions\Custom;

use App\Models\Loan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;
use Throwable;

class CreatePdf
{
    public static function createPdf(Loan $loan): void
    {
        $disk = Storage::disk('public');
        $fileName = 'loan_'.$loan->getKey().'_'.Str::uuid().'.pdf';

        try {
            $loan->getConnection()->transaction(function () use ($loan, $disk, $fileName) {
                $record = $loan->newQuery()->whereKey($loan->getKey())->lockForUpdate()->firstOrFail();
                $previousFile = $record->pdf_url;
                $pdf = Pdf::loadView('pdf_template', [
                    'loan' => $record,
                    'radios' => $record->radios()->orderBy('identifier')->get(),
                ])->setPaper('A4', 'portrait');

                if (! $disk->put($fileName, $pdf->output())) {
                    throw new RuntimeException('Unable to save the loan PDF.');
                }

                $record->pdf_url = $fileName;
                $record->date ??= now();
                if (! $record->saveOrFail()) {
                    throw new RuntimeException('Unable to save the loan PDF reference.');
                }

                // Keep the previous PDF until the database commit succeeds.
                $record->getConnection()->afterCommit(function () use ($disk, $previousFile) {
                    if ($previousFile) {
                        try {
                            if (! $disk->delete($previousFile)) {
                                report(new RuntimeException('Unable to remove the previous loan PDF.'));
                            }
                        } catch (Throwable $exception) {
                            report($exception);
                        }
                    }
                });
            });
        } catch (Throwable $exception) {
            $disk->delete($fileName);
            throw $exception;
        }

        $loan->refresh();
    }
}
