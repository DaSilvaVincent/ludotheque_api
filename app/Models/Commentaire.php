<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $table = 'commentaire';

    protected $fillable = [
        'commentaire', 'date_com', 'note', 'jeu_id','user_id'
    ];
}
