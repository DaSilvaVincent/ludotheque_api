<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jeu extends Model
{
    protected $table = 'jeu';
    use HasFactory;

    protected $fillable = [
        'nom', 'description', 'langue', 'url_media','age_min','nombre_joueurs_min','nombre_joueurs_max','duree_partie','valide','categorie_id','theme_id','editeur_id'
    ];
}
