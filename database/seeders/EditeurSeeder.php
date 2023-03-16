<?php

namespace Database\Seeders;

use App\Models\Editeur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EditeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Editeur::factory(3)->create();
        Editeur::factory([
            'nom' => "Hachette Boardgames",
        ])->create();
        Editeur::factory([
            'nom' => "Asmodee",
        ])->create();
        Editeur::factory([
            'nom' => "Ankama",
        ])->create();
        Editeur::factory([
            'nom' => "Blam !",
        ])->create();
        Editeur::factory([
            'nom' => "ATM Gaming",
        ])->create();
        Editeur::factory([
            'nom' => "Bombyx",
        ])->create();
        Editeur::factory([
            'nom' => "Capsicum Games",
        ])->create();
        Editeur::factory([
            'nom' => "Ferti",
        ])->create();
    }
}
