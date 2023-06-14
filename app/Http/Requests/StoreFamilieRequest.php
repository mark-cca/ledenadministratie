<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFamilieRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'naam' => 'required',
            'adres' => 'required',
        ];
    }
}
