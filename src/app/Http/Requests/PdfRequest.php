<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PdfRequest extends FormRequest
{
    public function prepareForValidation(): void
    {
        $this->merge([
            'path' => $this->route('path'),
        ]);
    }

    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'path' => ['required', 'string', 'regex:/\A[^\\\\\/\x00-\x1F]+\.pdf\z/i'],
        ];
    }
}
