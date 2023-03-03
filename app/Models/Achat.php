<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'date_achat', 'lieu_achat', 'prix', 'user_id','jeu_id'
    ];
}
