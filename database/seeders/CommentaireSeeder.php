<?php

namespace Database\Seeders;

use App\Models\Commentaire;
use App\Models\Jeu;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;

class CommentaireSeeder extends Seeder {

    protected $faker;

    public function __construct() {
        $this->faker = $this->withFaker();
    }

    protected function withFaker() {
        return Container::getInstance()->make(Generator::class);
    }

    /**
     * Run the database seeds.
     */
    public function run(): void {
        $jeu = Jeu::all()->pluck('id');
        $user = User::all()->pluck('id');

        Commentaire::factory()->create([
            'user_id' => $this->faker->randomElement($user),
            'jeu_id' => $this->faker->randomElement($jeu),
            'commentaire' => "Le jeu est sympa mais sans plus",
            'date_com' => $this->faker->dateTime(),
            'note' => $this->faker->randomElement($array = array(0,1,2,3,4,5)),
        ]);
        Commentaire::factory()->create([
            'user_id' => $this->faker->randomElement($user),
            'jeu_id' => $this->faker->randomElement($jeu),
            'commentaire' => "Le meilleur jeu en famille",
            'date_com' => $this->faker->dateTime(),
            'note' => $this->faker->randomElement($array = array(0,1,2,3,4,5)),
        ]);
        Commentaire::factory()->create([
            'user_id' => $this->faker->randomElement($user),
            'jeu_id' => $this->faker->randomElement($jeu),
            'commentaire' => "Gardez votre argents",
            'date_com' => $this->faker->dateTime(),
            'note' => $this->faker->randomElement($array = array(0,1,2,3,4,5)),
        ]);
        Commentaire::factory()->create([
            'user_id' => $this->faker->randomElement($user),
            'jeu_id' => $this->faker->randomElement($jeu),
            'commentaire' => "Parfait",
            'date_com' => $this->faker->dateTime(),
            'note' => $this->faker->randomElement($array = array(0,1,2,3,4,5)),
        ]);
        Commentaire::factory()->create([
            'user_id' => $this->faker->randomElement($user),
            'jeu_id' => $this->faker->randomElement($jeu),
            'commentaire' => "Trés bon jeu",
            'date_com' => $this->faker->dateTime(),
            'note' => $this->faker->randomElement($array = array(0,1,2,3,4,5)),
        ]);
        Commentaire::factory()->create([
            'user_id' => $this->faker->randomElement($user),
            'jeu_id' => $this->faker->randomElement($jeu),
            'commentaire' => "j'aurais aimer avoir sos ouistiti",
            'date_com' => $this->faker->dateTime(),
            'note' => $this->faker->randomElement($array = array(0,1,2,3,4,5)),
        ]);
        Commentaire::factory()->create([
            'user_id' => $this->faker->randomElement($user),
            'jeu_id' => $this->faker->randomElement($jeu),
            'commentaire' => "Mon éditeur préférer n'est pas la",
            'date_com' => $this->faker->dateTime(),
            'note' => $this->faker->randomElement($array = array(0,1,2,3,4,5)),
        ]);
        Commentaire::factory()->create([
            'user_id' => $this->faker->randomElement($user),
            'jeu_id' => $this->faker->randomElement($jeu),
            'commentaire' => "L'abonnement est trop cher",
            'date_com' => $this->faker->dateTime(),
            'note' => $this->faker->randomElement($array = array(0,1,2,3,4,5)),
        ]);
        Commentaire::factory()->create([
            'user_id' => $this->faker->randomElement($user),
            'jeu_id' => $this->faker->randomElement($jeu),
            'commentaire' => "y'avais de la lumière je suis rentrer",
            'date_com' => $this->faker->dateTime(),
            'note' => $this->faker->randomElement($array = array(0,1,2,3,4,5)),
        ]);
    }
}

