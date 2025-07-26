<?php

namespace App\Http\Controllers;

use App\Http\Mail\ClientCodeMail;
use App\Http\Requests\ClientCodeRequest;
use App\Models\Client;
use App\Enums\ClientProfileTypeEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;

class ClientCodeController extends Controller
{
    public function sendClientCode(ClientCodeRequest $request)
    {
        Log::info("QUAAA PRIMA");
        $parameters = $request->validated();
        Log::info("QUAAA VALIDATED");

        $client = new Client();
        $client->profile_type   = ClientProfileTypeEnum::from($parameters['profileType']);
        $client->message        = $parameters['message'] ?? null;
        $client->accept_privacy = $parameters['acceptPrivacy'];

        switch ($parameters['profileType']) {
            case ClientProfileTypeEnum::A->value: // Agency Profile
                $client->A_name         = $parameters['A_name'];
                $client->A_country      = $parameters['A_country'];
                $client->A_email        = $parameters['A_email'];
                $client->A_ref_name     = $parameters['A_ref_name'];
                $client->A_ref_surname  = $parameters['A_ref_surname'];
                $client->A_mobile       = $parameters['A_mobile'];
                $email = $parameters['A_email'];
                break;

            case ClientProfileTypeEnum::G->value: // Guide Profile
                $client->G_name     = $parameters['G_name'];
                $client->G_surname  = $parameters['G_surname'];
                $client->G_country  = $parameters['G_country'];
                $client->G_email    = $parameters['G_email'];
                $client->G_mobile   = $parameters['G_mobile'];
                $email = $parameters['G_email'];
                break;

            case ClientProfileTypeEnum::H->value: // Hotel Profile
                $client->H_name         = $parameters['H_name'];
                $client->H_email        = $parameters['H_email'];
                $client->H_ref_name     = $parameters['H_ref_name'];
                $client->H_ref_surname  = $parameters['H_ref_surname'];
                $client->H_mobile       = $parameters['H_mobile'];
                $email = $parameters['H_email'];
                break;

            case ClientProfileTypeEnum::L->value: // Laic Organizer Profile
                $client->L_name     = $parameters['L_name'];
                $client->L_surname  = $parameters['L_surname'];
                $client->L_country  = $parameters['L_country'];
                $client->L_email    = $parameters['L_email'];
                $client->L_mobile   = $parameters['L_mobile'];
                $email = $parameters['L_email'];
                break;

            case ClientProfileTypeEnum::R->value: // Religious Accompanist Profile
                $client->R_name     = $parameters['R_name'];
                $client->R_surname  = $parameters['R_surname'];
                $client->R_country  = $parameters['R_country'];
                $client->R_email    = $parameters['R_email'];
                $client->R_mobile   = $parameters['R_mobile'];
                $email = $parameters['R_email'];
                break;

            default:
                return response()->json(['error' => 'Invalid profile type'], 400);
        }

        // Save the client to the database
        $client->save();

        // TODO send email with code
        Mail::to($email)->send(new ClientCodeMail($client->id));

        return back()->with('success', 'Request submitted successfully!');
    }

    /**
     * Simulate sending an email with the client code (ID).
     *
     * @param string $email
     * @param int    $clientId
     * @return void
     */
    private function sendMailWithCode(string $email, int $clientId): void
    {
        Log::info('Sending mail with client code: ' . $clientId);
        Mail::to($email)->send(new ClientCodeMail($clientId));
    }
}
