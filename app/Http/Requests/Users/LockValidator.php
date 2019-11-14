<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use ActivismeBe\ValidationRules\Rules\MatchUserPassword;
use Illuminate\Support\Facades\Gate;

/**
 * Class LockValidator.
 */
class LockValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('deactivate-user', $this->userEntity);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'reden'      => ['required', 'string'],
            'wachtwoord' => ['required', 'string', new MatchUserPassword($this->user())],
        ];
    }
}
