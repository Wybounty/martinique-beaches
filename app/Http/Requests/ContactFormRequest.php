<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'telephone' => ['nullable', 'regex:/^[0-9]{10}$/'],
            'texte' => ['required', 'string'],
            'fax_number' => ['prohibited'],
        ];
    }
}
