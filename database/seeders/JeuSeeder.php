<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Editeur;
use App\Models\Jeu;
use App\Models\Theme;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;

class JeuSeeder extends Seeder {

    protected $faker;

    public function __construct() {
        $this->faker = $this->withFaker();
    }

    protected function withFaker() {
        return Container::getInstance()->make(Generator::class);
    }

    public function run(){
        //Jeu::factory(10)->create();
        $categorie_id = Categorie::all()->pluck('id');
        $theme_id = Theme::all()->pluck('id');
        $editeur_id = Editeur::all()->pluck('id');

        Jeu::factory([
            'nom' => "UNO",
            'description' => "Il faut se débarraser de toutes les cartes",
            'langue' => $this->faker->randomElement($array = array('Français','Anglais','Italien','Espagnole','Allemand')),
            'url_media' => "images/uno.jpg",
            'age_min' => 4,
            'nombre_joueurs_min' => 2,
            'nombre_joueurs_max' => 4,
            'duree_partie' => $this->faker->randomElement($array = array('10min','20min','30min','40min','50min','1h','1h15','1h30','1h45','2h','1h15','2h30','2h45','3h')),
            'valide' => true,
            'categorie_id' => $this->faker->randomElement($categorie_id),
            'theme_id' => $this->faker->randomElement($theme_id),
            'editeur_id' => $this->faker->randomElement($editeur_id),
        ])->create();

        Jeu::factory([
            'nom' => "Poker",
            'description' => "Il faut avoir la combinaison de carte la plus forte de la table",
            'langue' => $this->faker->randomElement($array = array('Français','Anglais','Italien','Espagnole','Allemand')),
            'url_media' => "images/poker.jpg",
            'age_min' => 18,
            'nombre_joueurs_min' => 2,
            'nombre_joueurs_max' => 6,
            'duree_partie' => $this->faker->randomElement($array = array('10min','20min','30min','40min','50min','1h','1h15','1h30','1h45','2h','1h15','2h30','2h45','3h')),
            'valide' => true,
            'categorie_id' => $this->faker->randomElement($categorie_id),
            'theme_id' => $this->faker->randomElement($theme_id),
            'editeur_id' => $this->faker->randomElement($editeur_id),
        ])->create();

        Jeu::factory([
            'nom' => "Bataille",
            'description' => "Il faut avoir 0 carte dans son tas de carte",
            'langue' => $this->faker->randomElement($array = array('Français','Anglais','Italien','Espagnole','Allemand')),
            'url_media' => "images/bataille.jpg",
            'age_min' => 4,
            'nombre_joueurs_min' => 1,
            'nombre_joueurs_max' => 2,
            'duree_partie' => $this->faker->randomElement($array = array('10min','20min','30min','40min','50min','1h','1h15','1h30','1h45','2h','1h15','2h30','2h45','3h')),
            'valide' => true,
            'categorie_id' => $this->faker->randomElement($categorie_id),
            'theme_id' => $this->faker->randomElement($theme_id),
            'editeur_id' => $this->faker->randomElement($editeur_id),
        ])->create();

        Jeu::factory([
            'nom' => "Scrabble",
            'description' => "Il faut marquer le plus de point en fesant des mots sur une grille avec ces lettres",
            'langue' => $this->faker->randomElement($array = array('Français','Anglais','Italien','Espagnole','Allemand')),
            'url_media' => "images/scrabble.jpg",
            'age_min' => 10,
            'nombre_joueurs_min' => 2,
            'nombre_joueurs_max' => 4,
            'duree_partie' => $this->faker->randomElement($array = array('10min','20min','30min','40min','50min','1h','1h15','1h30','1h45','2h','1h15','2h30','2h45','3h')),
            'valide' => true,
            'categorie_id' => $this->faker->randomElement($categorie_id),
            'theme_id' => $this->faker->randomElement($theme_id),
            'editeur_id' => $this->faker->randomElement($editeur_id),
        ])->create();

        Jeu::factory([
            'nom' => "Jeu de dame",
            'description' => "Il faut passer en diagonale sur les pions adverses",
            'langue' => $this->faker->randomElement($array = array('Français','Anglais','Italien','Espagnole','Allemand')),
            'url_media' => "images/jeudedame.jpg",
            'age_min' => 12,
            'nombre_joueurs_min' => 1,
            'nombre_joueurs_max' => 2,
            'duree_partie' => $this->faker->randomElement($array = array('10min','20min','30min','40min','50min','1h','1h15','1h30','1h45','2h','1h15','2h30','2h45','3h')),
            'valide' => true,
            'categorie_id' => $this->faker->randomElement($categorie_id),
            'theme_id' => $this->faker->randomElement($theme_id),
            'editeur_id' => $this->faker->randomElement($editeur_id),
        ])->create();

        Jeu::factory([
            'nom' => "Rami",
            'description' => "Il faut avoir 0 cartes dans sa main pour finir",
            'langue' => $this->faker->randomElement($array = array('Français','Anglais','Italien','Espagnole','Allemand')),
            'url_media' => "images/rami.jpg",
            'age_min' => 8,
            'nombre_joueurs_min' => 2,
            'nombre_joueurs_max' => 8,
            'duree_partie' => $this->faker->randomElement($array = array('10min','20min','30min','40min','50min','1h','1h15','1h30','1h45','2h','1h15','2h30','2h45','3h')),
            'valide' => true,
            'categorie_id' => $this->faker->randomElement($categorie_id),
            'theme_id' => $this->faker->randomElement($theme_id),
            'editeur_id' => $this->faker->randomElement($editeur_id),
        ])->create();

        Jeu::factory([
            'nom' => "Monopoly",
            'description' => "Être le plus riche du plateau",
            'langue' => $this->faker->randomElement($array = array('Français','Anglais','Italien','Espagnole','Allemand')),
            'url_media' => "images/monopoly.jpg",
            'age_min' => 12,
            'nombre_joueurs_min' => 2,
            'nombre_joueurs_max' => 8,
            'duree_partie' => $this->faker->randomElement($array = array('10min','20min','30min','40min','50min','1h','1h15','1h30','1h45','2h','1h15','2h30','2h45','3h')),
            'valide' => true,
            'categorie_id' => $this->faker->randomElement($categorie_id),
            'theme_id' => $this->faker->randomElement($theme_id),
            'editeur_id' => $this->faker->randomElement($editeur_id),
        ])->create();

        Jeu::factory([
            'nom' => "1000 bornes",
            'description' => "Il faut parcourir toutes la route pour gagner",
            'langue' => $this->faker->randomElement($array = array('Français','Anglais','Italien','Espagnole','Allemand')),
            'url_media' => "images/1000bornes.jpg",
            'age_min' => 8,
            'nombre_joueurs_min' => 2,
            'nombre_joueurs_max' => 5,
            'duree_partie' => $this->faker->randomElement($array = array('10min','20min','30min','40min','50min','1h','1h15','1h30','1h45','2h','1h15','2h30','2h45','3h')),
            'valide' => true,
            'categorie_id' => $this->faker->randomElement($categorie_id),
            'theme_id' => $this->faker->randomElement($theme_id),
            'editeur_id' => $this->faker->randomElement($editeur_id),
        ])->create();

        Jeu::factory([
            'nom' => "Blackjack",
            'description' => "Il faut se rapprocher le plus possible de 21",
            'langue' => $this->faker->randomElement($array = array('Français','Anglais','Italien','Espagnole','Allemand')),
            'url_media' => "images/blackjack.jpg",
            'age_min' => 18,
            'nombre_joueurs_min' => 1,
            'nombre_joueurs_max' => 5,
            'duree_partie' => $this->faker->randomElement($array = array('10min','20min','30min','40min','50min','1h','1h15','1h30','1h45','2h','1h15','2h30','2h45','3h')),
            'valide' => true,
            'categorie_id' => $this->faker->randomElement($categorie_id),
            'theme_id' => $this->faker->randomElement($theme_id),
            'editeur_id' => $this->faker->randomElement($editeur_id),
        ])->create();

        Jeu::factory([
            'nom' => "Le jeu de l'oie",
            'description' => "Il faut faire tous le tour du plateau",
            'langue' => $this->faker->randomElement($array = array('Français','Anglais','Italien','Espagnole','Allemand')),
            'url_media' => "images/jeudeloie.jpg",
            'age_min' => 8,
            'nombre_joueurs_min' => 2,
            'nombre_joueurs_max' => 4,
            'duree_partie' => $this->faker->randomElement($array = array('10min','20min','30min','40min','50min','1h','1h15','1h30','1h45','2h','1h15','2h30','2h45','3h')),
            'valide' => true,
            'categorie_id' => $this->faker->randomElement($categorie_id),
            'theme_id' => $this->faker->randomElement($theme_id),
            'editeur_id' => $this->faker->randomElement($editeur_id),
        ])->create();

        Jeu::factory([
            'nom' => "La bonne paie",
            'description' => "Être le plus riche",
            'langue' => $this->faker->randomElement($array = array('Français','Anglais','Italien','Espagnole','Allemand')),
            'age_min' => 6,
            'nombre_joueurs_min' => 2,
            'nombre_joueurs_max' => 4,
            'duree_partie' => $this->faker->randomElement($array = array('10min','20min','30min','40min','50min','1h','1h15','1h30','1h45','2h','1h15','2h30','2h45','3h')),
            'valide' => true,
            'categorie_id' => $this->faker->randomElement($categorie_id),
            'theme_id' => $this->faker->randomElement($theme_id),
            'editeur_id' => $this->faker->randomElement($editeur_id),
        ])->create();
    }
}
