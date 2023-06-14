<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContributieRequest extends FormRequest
{
    /**
     * Bepaal of de gebruiker geautoriseerd is om dit verzoek te maken.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Haal de validatieregels op die van toepassing zijn op het verzoek.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bedrag' => 'required|numeric',
        ];
    }

    /**
     * Haal de vertaalde validatiefoutmeldingen op.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'bedrag.required' => 'Het bedrag is verplicht.',
            'bedrag.numeric' => 'Het bedrag moet numeriek zijn.',
        ];
    }
}
