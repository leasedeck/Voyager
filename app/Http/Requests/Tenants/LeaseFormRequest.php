<?php

namespace App\Http\Requests\Tenants;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LeaseFormRequest
 *
 * @package App\Http\Requests\Tenants
 */
class LeaseFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'start_datum'       => ['required', 'date', 'date_format:Y-m-d', 'before:eind_datum'],
            'eind_datum'        => ['required', 'date', 'date_format:Y-m-d', 'after:start_datum'],
            'aantal_personen'   => ['required', 'integer'],
            'status'            => ['required', 'string'],
        ];
    }
}
