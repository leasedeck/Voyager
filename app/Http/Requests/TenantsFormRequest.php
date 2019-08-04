<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TenantsFormRequest
 *
 * @package App\Http\Requests
 */
class TenantsFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'voornaam'      => ['required', 'string'],
            'achternaam'    => ['required', 'string'],
            'email'         => ['required', 'email', 'max:191', 'unique:users'],
            'postcode'      => ['required', 'string'],
            'stad'          => ['required', 'string'],
            'adres'         => ['required', 'string'],
            'land_id'       => ['required', 'string', 'integer'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function messages(): array
    {
        return ['land_id.required' => 'U moet een land opgeven voor de huurder.'];
    }
}
