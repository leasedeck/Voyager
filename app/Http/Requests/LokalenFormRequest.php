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
     * Method specific rules defined by request type.
     *
     * @return array
     */
    private function methodSpecificRules(): array
    {
        switch ($this->getMethod()) {
            case 'PATCH':   return ['naam' => ['required', 'string', 'max:250', 'unique:lokalens,naam,' . $this->lokaal->id]];
            case 'POST':    return ['naam' => ['required', 'string', 'max:200', 'unique:lokalens']];
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge([
            'verantwoordelijke_algemeen'    => ['required', 'integer'],
            'verantwoordelijke_onderhoud'   => ['required', 'integer'],
            'aantal_personen'               => ['required', 'integer'],
            'capaciteits_type'              => ['required', 'string', 'max:200'],
            'werkpunten_beheer'             => ['required', 'boolean'],
        ], $this->methodSpecificRules());
    }
}
