<?php

namespace Database\Seeders;


use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Theme::factory(3)->create();
        Theme::factory([
            'nom' => "Astérix et Obélix",
        ])->create();
        Theme::factory([
            'nom' => "Spectacles de marionnettes",
        ])->create();
        Theme::factory([
            'nom' => "Pour les vacances",
        ])->create();
        Theme::factory([
            'nom' => "Animaux sauvages",
        ])->create();
        Theme::factory([
            'nom' => "Harry Potter",
        ])->create();
        Theme::factory([
            'nom' => "Fables de La Fontaine",
        ])->create();
        Theme::factory([
            'nom' => "animaux domestiques",
        ])->create();
        Theme::factory([
            'nom' => "Petit Ours Brun",
        ])->create();
        Theme::factory([
            'nom' => "Empire Romain",
        ])->create();
        Theme::factory([
            'nom' => "Conquête spatiale",
        ])->create();
        Theme::factory([
            'nom' => "Enigmes",
        ])->create();
        Theme::factory([
            'nom' => "La ferme",
        ])->create();
        Theme::factory([
            'nom' => "Fans de pompiers",
        ])->create();
        Theme::factory([
            'nom' => "Autour de l'art",
        ])->create();
        Theme::factory([
            'nom' => "Les chavaliers",
        ])->create();
        Theme::factory([
            'nom' => "Des pirates",
        ])->create();
        Theme::factory([
            'nom' => "Mythologie",
        ])->create();

    }
}
