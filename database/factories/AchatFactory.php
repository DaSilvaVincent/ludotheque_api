<?php

namespace Database\Factories;

use App\Models\Achat;
use App\Models\Jeu;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AchatFactory extends Factory
{
    protected $model = Achat::class;

    public function definition()
    {
        $jeu = Jeu::all()->pluck('id');
        $user = User::all()->pluck('id');
        return [
            'date_achat' => $this->faker->dateTimeThisYear(),
            'lieu_achat' => $this->faker->city(),
            'prix' => $this->faker->randomFloat(2, 0, 1000),
            'user_id' => $this->faker->randomElement($user),
            'jeu_id' => $this->faker->randomElement($jeu)
        ];
    }
}
