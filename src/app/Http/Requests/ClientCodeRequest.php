<?php

namespace App\Http\Requests;

use App\Enums\ClientProfileTypeEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ClientCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        Log::info("RULES CLIENT CODE REQUEST");
        return [
            // Discriminator for profile variant
            'profileType'    => ['required', 'string', Rule::in(ClientProfileTypeEnum::toArray())],

            // Common fields
            'message'        => ['nullable', 'string', 'max:1000'],
            'acceptPrivacy'  => ['accepted'],

            // Travel Agency (“A”)
            'A_name'         => ['required_if:profileType,A', 'string', 'max:255'],
            'A_country'      => ['required_if:profileType,A', 'string', 'size:2'],
            'A_email'        => ['required_if:profileType,A', 'email',  'max:255'],
            'A_ref_name'     => ['required_if:profileType,A', 'string', 'max:255'],
            'A_ref_surname'  => ['required_if:profileType,A', 'string', 'max:255'],
            'A_mobile'       => ['required_if:profileType,A', 'string', 'max:20'],

            // Guide (“G”)
            'G_name'         => ['required_if:profileType,G', 'string', 'max:255'],
            'G_surname'      => ['required_if:profileType,G', 'string', 'max:255'],
            'G_country'      => ['required_if:profileType,G', 'string', 'size:2'],
            'G_email'        => ['required_if:profileType,G', 'email',  'max:255'],
            'G_mobile'       => ['required_if:profileType,G', 'string', 'max:20'],

            // Accommodation Provider (“H”)
            'H_name'         => ['required_if:profileType,H', 'string', 'max:255'],
            'H_email'        => ['required_if:profileType,H', 'email',  'max:255'],
            'H_ref_name'     => ['required_if:profileType,H', 'string', 'max:255'],
            'H_ref_surname'  => ['required_if:profileType,H', 'string', 'max:255'],
            'H_mobile'       => ['required_if:profileType,H', 'string', 'max:20'],

            // Lay Organizer (“L”)
            'L_name'         => ['required_if:profileType,L', 'string', 'max:255'],
            'L_surname'      => ['required_if:profileType,L', 'string', 'max:255'],
            'L_country'      => ['required_if:profileType,L', 'string', 'size:2'],
            'L_email'        => ['required_if:profileType,L', 'email',  'max:255'],
            'L_mobile'       => ['required_if:profileType,L', 'string', 'max:20'],

            // Religious Accompanist (“R”)
            'R_name'         => ['required_if:profileType,R', 'string', 'max:255'],
            'R_surname'      => ['required_if:profileType,R', 'string', 'max:255'],
            'R_country'      => ['required_if:profileType,R', 'string', 'size:2'],
            'R_email'        => ['required_if:profileType,R', 'email',  'max:255'],
            'R_mobile'       => ['required_if:profileType,R', 'string', 'max:20'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        Log::info("Validation failed", $validator->errors()->toArray());
        return response(status: 400);
    }
}
