<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LokalenFormRequest 
 * 
 * @package App\Http\Requests
 */
class LokalenFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'naam'                          => ['required', 'string', 'max:200', 'unique:lokalens'],
            'verantwoordelijke_algemeen'    => ['required', 'integer'],
            'verantwoordelijke_onderhoud'   => ['required', 'integer'],
            'aantal_personen'               => ['required', 'string'],
            'capaciteits_type'              => ['required', 'string', 'max:200'],
            'werkpunten_beheer'             => ['required', 'boolean'],
        ];
    }
}
