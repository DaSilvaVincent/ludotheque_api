<?php

namespace Database\Seeders;

use App\Models\Commentaire;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Commentaire::factory()->create([
            'user_id' => 1,
            'jeu_id' => 1,
            'commentaire' => "Le jeu est sympa mais sans plus",
            'date' => Carbon::parse('2022-05-08'),
            'note' => 3,
        ]);
        Commentaire::factory()->create([
            'user_id' => 2,
            'jeu_id' => 1,
            'commentaire' => "Le meilleur jeu en famille",
            'date' => Carbon::parse('2023-02-02'),
            'note' => 4,
        ]);
        Commentaire::factory()->create([
            'user_id' => 3,
            'jeu_id' => 2,
            'commentaire' => "Gardez votre argents",
            'date' => Carbon::parse('2022-09-10'),
            'note' => 0,
        ]);
        Commentaire::factory()->create([
            'user_id' => 5,
            'jeu_id' => 4,
            'commentaire' => "Parfait",
            'date' => Carbon::parse('2022-12-03'),
            'note' => 5,
        ]);
    }
}
