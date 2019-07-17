<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use ActivismeBe\ValidationRules\Rules\MatchUserPassword;

/**
 * Class SecurityValidator.
 */
class SecurityValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'wachtwoord' => ['required', 'string', 'min:8', 'confirmed'],
            'huidig_wachtwoord' => ['required', 'string', new MatchUserPassword($this->user())],
        ];
    }
}
