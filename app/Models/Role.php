<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role';

    public function jeux() {
        return $this->hasOne(Jeu::class);
    }

    public function Users() {
        return $this->hasOne(User::class);
    }
}
