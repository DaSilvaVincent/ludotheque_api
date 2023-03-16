<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class AdherentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'login' => "required|string|between:5,50",
            'email' => "required|string|between:5,50",
            'nom' => "required|string|between:5,50",
            'password' => "required|string|between:5,50",
            'prenom' => "required|string|between:5,50",
            'pseudo ' => "required|string|between:5,50"
        ];
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['required' => "string", 'between' => "string"])] public function messages(): array
    {
        return [
            'required' => 'Le champ :attribute est obligatoire.',
            'between' => 'Le champ :attribute doit contenir entre :min et :max caractères.',
        ];
    }
}
