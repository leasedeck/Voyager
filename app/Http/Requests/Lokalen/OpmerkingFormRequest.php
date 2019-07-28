<?php

namespace App\Http\Requests\Lokalen;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class OpmerkingFormRequest
 *
 * @package App\Http\Requests\Lokalen
 */
class OpmerkingFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return ['titel' => ['required', 'string', 'max:255'], 'opmerking' => ['required', 'string']];
    }
}
