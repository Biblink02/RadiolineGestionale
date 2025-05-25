<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientCodeRequest;
use App\Models\Client;
use App\Enums\ClientProfileTypeEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ClientCodeController extends Controller
{
    public function sendClientCode(ClientCodeRequest $request): JsonResponse
    {
        $parameters = $request->validated();

        $client = new Client();
        $client->profile_type = ClientProfileTypeEnum::from($parameters['profileType']);
        $client->message = $parameters['message'] ?? null;
        $client->accept_privacy = $parameters['acceptPrivacy'];
        $email = null;
        switch ($parameters['profileType']) {
            case ClientProfileTypeEnum::A->value: // Agency Profile
                $client->agency_name = $parameters['agencyName'];
                $client->agency_country = $parameters['agencyCountry'];
                $client->agency_email = $parameters['agencyEmail'];
                $client->agency_ref_name = $parameters['agencyRefName'];
                $client->agency_ref_surname = $parameters['agencyRefSurname'];
                $client->agency_mobile = $parameters['agencyMobile'];
                $email = $parameters['agencyEmail'];
                break;

            case ClientProfileTypeEnum::G->value: // Guide Profile
                $client->guide_name = $parameters['guideName'];
                $client->guide_surname = $parameters['guideSurname'];
                $client->guide_country = $parameters['guideCountry'];
                $client->guide_email = $parameters['guideEmail'];
                $client->guide_mobile = $parameters['guideMobile'];
                $email = $parameters['guideEmail'];
                break;

            case ClientProfileTypeEnum::H->value: // Hotel Profile
                $client->hotel_name = $parameters['hotelName'];
                $client->hotel_email = $parameters['hotelEmail'];
                $client->hotel_ref_name = $parameters['hotelRefName'];
                $client->hotel_ref_surname = $parameters['hotelRefSurname'];
                $client->hotel_mobile = $parameters['hotelMobile'];
                $email = $parameters['hotelEmail'];
                break;

            case ClientProfileTypeEnum::L->value: // Laic Organizer Profile
                $client->laic_name = $parameters['laicName'];
                $client->laic_surname = $parameters['laicSurname'];
                $client->laic_country = $parameters['laicCountry'];
                $client->laic_email = $parameters['laicEmail'];
                $client->laic_mobile = $parameters['laicMobile'];
                $email = $parameters['laicEmail'];
                break;

            case ClientProfileTypeEnum::R->value: // Religious Accompanist Profile
                $client->rel_name = $parameters['relName'];
                $client->rel_surname = $parameters['relSurname'];
                $client->rel_country = $parameters['relCountry'];
                $client->rel_email = $parameters['relEmail'];
                $client->rel_mobile = $parameters['relMobile'];
                $email = $parameters['relEmail'];
                break;

            default:
                return response()->json(['error' => 'Invalid profile type'], 400);
        }

        // Save the client to the database
        $client->save();

        // Call sendMailWithCode function with the created client ID
        $this->sendMailWithCode($email, $client->id);

        // Return a successful response with the client ID
        return response()->json(['client_id' => $client->id, 'message' => 'Client profile created and code sent successfully.']);
    }

    /**
     * Simulate sending an email with the client code (ID).
     *
     * @param int $clientId
     * @return void
     */
    private function sendMailWithCode(string $email, int $clientId): void
    {
        Log::info('Sending mail with client code: ' . $clientId);
        Mail::to($email)->send(new OrderSummary(order: $order));
    }
}
