<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientCodeRequest;
use Illuminate\Http\JsonResponse;

class ClientCodeController extends Controller
{
    public function sendClientCode(ClientCodeRequest $request): JsonResponse
    {
        $parameters = $request->validated();
        // TODO crea oggetti e manda mail/whatsapp vedi insomma
        return response()->json();
    }
}
