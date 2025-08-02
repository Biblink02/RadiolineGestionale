<?php

namespace App\Http\Controllers;

use App\Enums\ContactFormProfileTypeEnum;
use App\Http\Mail\ContactFormMail;
use App\Http\Requests\ContactFormRequest;
use App\Models\ContactForm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function handleContactFormRequest(ContactFormRequest $request): RedirectResponse
    {
        $parameters = $request->validated();
        $country = config('countries.' . $parameters['country']);
        $form = ContactForm::create([
            'firstName' => $parameters['firstName'],
            'lastName' => $parameters['lastName'],
            'phone' => $parameters['phone'] ?? null,
            'email' => $parameters['email'],
            'country' => $country ?? null,
            'profileType' => ContactFormProfileTypeEnum::from($parameters['profileType']),
            'message' => $parameters['message'],
        ]);

        Mail::to($parameters['email'])->send(new ContactFormMail(
            $parameters['firstName'],
            $parameters['lastName'],
            $parameters['language'] ?? null,
            $form));
        return redirect()->route('page.contact-us')->with('success', 'Thanks for contacting us!');
    }

}
