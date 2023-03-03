<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Theme;
use App\Models\Editeur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jeu>
 */
class JeuFactory extends Factory
{
    private static $i = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categorie_id = Categorie::all()->pluck('id');
        $theme_id = Theme::all()->pluck('id');
        $editeur_id = Editeur::all()->pluck('id');
        return [
            'id' => self::$i++,
            'nom' => $this->faker->randomElement($array = array('test','test2','test3')),
            'description' => $this->faker->randomElement($array),
            'langue' => $this->faker->randomElement($array),
            'url_media' => $this->faker->randomElement($array),
            'age_min' => $this->faker->randomDigit(),
            'nombre_joueurs_min' => $this->faker->randomDigit(),
            'nombre_joueurs_max' => $this->faker->randomDigit(),
            'duree_partie' => $this->faker->randomElement($array),
            'valide' => $this->faker->boolean,
            'categorie_id' => $this->faker->randomElement($categorie_id),
            'theme_id' => $this->faker->randomElement($theme_id),
            'editeur_id' => $this->faker->randomElement($editeur_id),
        ];
    }
}
