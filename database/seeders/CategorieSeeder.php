<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Categorie::factory(3)->create();
        Categorie::factory([
            'nom' => "Jeux de dés",
        ])->create();
        Categorie::factory([
            'nom' => "Jeux d'adresse",
        ])->create();
        Categorie::factory([
            'nom' => "Jeux d'anmiance",
        ])->create();
        Categorie::factory([
            'nom' => "Jeux de cartes",
        ])->create();
        Categorie::factory([
            'nom' => "Jeux de plateau",
        ])->create();
        Categorie::factory([
            'nom' => "Jeux de mémoire",
        ])->create();
        Categorie::factory([
            'nom' => "Jeux de connaissance",
        ])->create();
        Categorie::factory([
            'nom' => "Jeux de lettres",
        ])->create();
        Categorie::factory([
            'nom' => "Jeux de logique",
        ])->create();
        Categorie::factory([
            'nom' => "Jeux de pions",
        ])->create();
        Categorie::factory([
            'nom' => "Jeux éducatifs",
        ])->create();
        Categorie::factory([
            'nom' => "Jeux d'enquête",
        ])->create();
        Categorie::factory([
            'nom' => "Jeux de coopération",
        ])->create();
        Categorie::factory([
            'nom' => "Jeux de bluff",
        ])->create();
        Categorie::factory([
            'nom' => "Jeux de stratégie",
        ])->create();
        Categorie::factory([
            'nom' => "Jeux de gestion",
        ])->create();
        Categorie::factory([
            'nom' => "Jeux de hasard",
        ])->create();
        Categorie::factory([
            'nom' => "Jeux de rôle",
        ])->create();
        Categorie::factory([
            'nom' => "Jeux créatifs",
        ])->create();
    }
}
