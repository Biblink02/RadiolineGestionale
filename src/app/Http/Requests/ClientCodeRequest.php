<?php

namespace App\Http\Requests;

use App\Enums\ClientProfileTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Discriminator for profile variant
            'profileType'    => ['required', 'string', Rule::in(ClientProfileTypeEnum::toArray())],

            // Common fields
            'message'        => ['nullable', 'string', 'max:1000'],
            'acceptPrivacy'  => ['accepted'],

            // Travel Agency (“A”)
            'agencyName'      => ['required_if:profileType,A', 'string', 'max:255'],
            'agencyCountry'   => ['required_if:profileType,A', 'string', 'size:2'],
            'agencyEmail'     => ['required_if:profileType,A', 'email',  'max:255'],
            'agencyRefName'   => ['required_if:profileType,A', 'string', 'max:255'],
            'agencyRefSurname'=> ['required_if:profileType,A', 'string', 'max:255'],
            'agencyMobile'    => ['required_if:profileType,A', 'string', 'max:20'],

            // Guide (“G”)
            'guideName'     => ['required_if:profileType,G', 'string', 'max:255'],
            'guideSurname'  => ['required_if:profileType,G', 'string', 'max:255'],
            'guideCountry'  => ['required_if:profileType,G', 'string', 'size:2'],
            'guideEmail'    => ['required_if:profileType,G', 'email',  'max:255'],
            'guideMobile'   => ['required_if:profileType,G', 'string', 'max:20'],

            // Accommodation Provider (“H”)
            'hotelName'      => ['required_if:profileType,H', 'string', 'max:255'],
            'hotelEmail'     => ['required_if:profileType,H', 'email',  'max:255'],
            'hotelRefName'   => ['required_if:profileType,H', 'string', 'max:255'],
            'hotelRefSurname'=> ['required_if:profileType,H', 'string', 'max:255'],
            'hotelMobile'    => ['required_if:profileType,H', 'string', 'max:20'],

            // Lay Organizer (“L”)
            'laicName'       => ['required_if:profileType,L', 'string', 'max:255'],
            'laicSurname'    => ['required_if:profileType,L', 'string', 'max:255'],
            'laicCountry'    => ['required_if:profileType,L', 'string', 'size:2'],
            'laicEmail'      => ['required_if:profileType,L', 'email',  'max:255'],
            'laicMobile'     => ['required_if:profileType,L', 'string', 'max:20'],

            // Religious Accompanist (“R”)
            'relName'        => ['required_if:profileType,R', 'string', 'max:255'],
            'relSurname'     => ['required_if:profileType,R', 'string', 'max:255'],
            'relCountry'     => ['required_if:profileType,R', 'string', 'size:2'],
            'relEmail'       => ['required_if:profileType,R', 'email',  'max:255'],
            'relMobile'      => ['required_if:profileType,R', 'string', 'max:20'],
        ];
    }
}
