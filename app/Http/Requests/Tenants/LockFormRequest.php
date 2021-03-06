<?php

namespace App\Http\Requests\Tenants;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LockFormRequest
 *
 * @package App\Http\Requests\Tenants
 */
class LockFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->user()->can('lock', $this->tenant);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return ['comment' => ['required', 'string']];
    }

    /**
     * {@inheritdoc}
     */
    public function messages(): array
    {
        return ['comment.*' => 'Beschrijf waarom de huurder wordt gedeactiveerd.'];
    }
}
