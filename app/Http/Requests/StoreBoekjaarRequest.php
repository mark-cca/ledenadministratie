<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBoekjaarRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust the authorization logic if needed
    }

    public function rules()
    {
        return [
            'jaar' => 'required|integer|digits:4',
        ];
    }

    public function messages()
    {
        return [
            'jaar.required' => 'Het jaar is verplicht.',
            'jaar.integer' => 'Het jaar moet een geheel getal zijn.',
            'jaar.digits' => 'Het jaar moet uit 4 cijfers bestaan.',
        ];
    }
}
