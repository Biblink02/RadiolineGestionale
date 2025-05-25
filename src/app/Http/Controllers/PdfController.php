<?php

namespace App\Http\Controllers;

use App\Http\Requests\PdfRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PdfController extends Controller
{
    public function getPdf(PdfRequest $request): BinaryFileResponse
    {
        $parameters = $request->validated();
        if (!Storage::disk('public')->exists($parameters['path'])) {
            abort(404, 'PDF not found');
        }
        return response()->file(Storage::disk('public')->path($parameters['path']));
    }
}
