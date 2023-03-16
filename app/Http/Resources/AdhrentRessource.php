<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdhrentRessource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'login' => $this->login,
            'name' => $this->nom,
            'email' => $this->email,
            'password' => $this->password,
            'prenom' => $this->prenom,
            'pseudo' => $this->pseudo
        ];

    }
}
