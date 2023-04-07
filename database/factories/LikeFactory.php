<?php

namespace Database\Factories;

use App\Models\Jeu;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jeu = Jeu::all()->pluck('id');
        $user = User::all()->pluck('id');
        return [
                'user_id' => $this->faker->randomElement($user),
                'jeu_id' => $this->faker->randomElement($jeu)
        ];
    }
}
