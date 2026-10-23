<?php

namespace App\Http\Requests;

use App\Enums\ContactFormProfileTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'phone' => 'required|phone',
            'email' => 'required|email|max:255',
            'country' => ['required', 'string', Rule::in(array_keys(config('countries')))],
            'profileType' => ['required', Rule::enum(ContactFormProfileTypeEnum::class)],
            'message' => 'required|string|max:10000',
            'acceptPrivacy' => 'accepted',
            'language' => ['nullable', Rule::in(config('custom.lang.available'))],
        ];
    }
}
