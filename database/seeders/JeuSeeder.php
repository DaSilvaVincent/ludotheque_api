<?php

namespace Database\Seeders;

use App\Models\Jeu;
use Illuminate\Database\Seeder;

class JeuSeeder extends Seeder
{
    public function run(){
        Jeu::factory(10)->create();
    }
}
