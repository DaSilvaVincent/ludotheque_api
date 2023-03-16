<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JeuRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return ['nom' => "required|string|between:5,50",
            'description' => "required|string|between:5,500",
            'langue' => "required|string",
            'age_min' => "required|number|between:4,18",
            'nombre_joueurs_min' => "required|integer|between:1,4",
            'nombre_joueurs_max' => "required|integer|between:5,8",
            'duree_partie' => "required|string|",
            'categorie' => "required|number|",
            'theme' => "required|number|",
            'editeur' => "required|number|"];
    }
}
