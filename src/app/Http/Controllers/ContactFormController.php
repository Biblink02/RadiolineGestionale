<?php

namespace App\Http\Controllers;

use App\Enums\ContactFormProfileTypeEnum;
use App\Http\Mail\ClientCodeMail;
use App\Http\Mail\ContactFormMail;
use App\Http\Requests\ContactFormRequest;
use App\Models\ContactForm;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function handleContactFormRequest(ContactFormRequest $request)
    {
        $parameters = $request->validated();
        $country = config('countries.'.$parameters['country']);
        $contactForm = ContactForm::create([
            'firstName'    => $parameters['firstName'],
            'lastName'     => $parameters['lastName'],
            'phone'        => $parameters['phone'] ?? null,
            'email'        => $parameters['email'],
            'country'      => $country ?? null,
            'profileType'  => ContactFormProfileTypeEnum::from($parameters['profileType']),
            'message'      => $parameters['message'],
        ]);


    }

    /**
     * Simulate sending an email with the client code (ID).
     *
     * @param string $email
     * @param int    $clientId
     * @return void
     */
    private function sendMail(string $email, string $firstName, string $lastName): void
    {
        Mail::to($email)->send(new ContactFormMail());
    }
}
