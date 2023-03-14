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
            'nom' => $this->faker->randomElement($array = array('UNO','Rubik\'s Cube','Jeu de dame','Poker','Bataille','Scrabble')),
            'description' => $this->faker->randomElement($array = array('Il faut se débarasser de toutes ses cartes','Il faut que toutes les faces soient de la même couleur','Il faut prendre les pions de l\'adversaire','Il faut prendre les cartes de l\'adversaire','Il faut faire le plus de points en formant des mots avec les lettres données')),
            'langue' => $this->faker->randomElement($array = array('Français','Anglais')),
            'age_min' => $this->faker->randomDigit(),
            'nombre_joueurs_min' => $this->faker->randomDigit(),
            'nombre_joueurs_max' => $this->faker->randomDigit(),
            'duree_partie' => $this->faker->randomElement($array = array('10min','30min','1h','1h30','2h','2h30','3h')),
            'valide' => $this->faker->boolean,
            'categorie_id' => $this->faker->randomElement($categorie_id),
            'theme_id' => $this->faker->randomElement($theme_id),
            'editeur_id' => $this->faker->randomElement($editeur_id),
        ];
    }
}
