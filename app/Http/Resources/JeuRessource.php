<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JeuRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ['id'=>$this->id,
            'nom'=>$this->nom,
            'description'=>$this->description,
            'langue'=>$this->langue,
            'url_media'=>$this->url_media,
            'age_min'=>$this->age_min,
            'nombre_joueurs_min'=>$this->nombre_joueurs_min,
            'nombre_joueurs_max'=>$this->nombre_joueurs_max,
            'duree_partie'=>$this->duree_partie,
            'valide'=>$this->valide,
            'categorie_id'=>$this->categorie_id,
            'theme_id'=>$this->theme_id,
            'editeur_id'=>$this->editeur_id];
    }
}
