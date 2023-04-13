<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(){
        User::factory(10)->create();
        User::factory()->create([
            'login' => "LeLogin",
            'email' => "vincentAdmin@domain.fr",
            'email_verified_at' => now(),
            'password' => Hash::make('UnSecret'),
            'valide' => true,
            'nom' => "Dupond",
            'prenom' => "Thibault",
            'pseudo' => "Essai",
            'avatar' => "images/dracaufeu.jpg",
            'remember_token' => Str::random(10),
        ]);
        User::factory()->create([
            'login' => "LeLogin",
            'email' => "vincentModerateur@domain.fr",
            'email_verified_at' => now(),
            'password' => Hash::make('UnSecret'),
            'valide' => true,
            'nom' => "Dupond",
            'prenom' => "Thibault",
            'pseudo' => "Essai",
            'avatar' => "images/no_image.png",
            'remember_token' => Str::random(10),
        ]);
        User::factory()->create([
            'login' => "LeLogin",
            'email' => "vincentAdherentPrem@domain.fr",
            'email_verified_at' => now(),
            'password' => Hash::make('UnSecret'),
            'valide' => true,
            'nom' => "Dupond",
            'prenom' => "Thibault",
            'pseudo' => "Essai",
            'avatar' => "images/no_image.png",
            'remember_token' => Str::random(10),
        ]);
        User::factory()->create([
            'login' => "LeLogin",
            'email' => "vincentAdherent@domain.fr",
            'email_verified_at' => now(),
            'password' => Hash::make('UnSecret'),
            'valide' => true,
            'nom' => "Dupond",
            'prenom' => "Thibault",
            'pseudo' => "Essai",
            'avatar' => "images/no_image.png",
            'remember_token' => Str::random(10),
        ]);
        User::factory()->create([
            'login' => "LeLogin",
            'email' => "vincentVisitor@domain.fr",
            'email_verified_at' => now(),
            'password' => Hash::make('UnSecret'),
            'valide' => true,
            'nom' => "Dupond",
            'prenom' => "Thibault",
            'pseudo' => "Essai",
            'avatar' => "images/no_image.png",
            'remember_token' => Str::random(10),
        ]);
    }
}
