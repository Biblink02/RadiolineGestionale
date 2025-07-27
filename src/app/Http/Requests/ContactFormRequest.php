<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class ContactFormRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'firstName' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'phone' => 'nullable|phone',
            'email' => 'required|email|max:255',
            'country' => 'required|string|size:2', // codice ISO
            'profileType' => 'nullable|string|max:50',
            'message' => 'required|string',
            'acceptPrivacy' => 'accepted',
            'language' => 'nullable|string|size:2',
        ];
    }
}
