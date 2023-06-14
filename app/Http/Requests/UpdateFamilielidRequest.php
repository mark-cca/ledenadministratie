<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFamilielidRequest extends FormRequest
{
    /**
     * Bepaal of de gebruiker gemachtigd is om dit verzoek te maken.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Haal de validatieregels op die van toepassing zijn op het verzoek.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'naam' => 'required',
            'geboortedatum' => 'required|date',
        ];
    }
}
