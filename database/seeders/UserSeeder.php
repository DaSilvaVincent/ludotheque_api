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
            'login' => "vincent",
            'email' => "vincentAdmin@domain.fr",
            'email_verified_at' => now(),
            'password' => Hash::make('UnSecret'),
            'valide' => true,
            'nom' => "vincent",
            'prenom' => "vinz",
            'pseudo' => "das",
            'avatar' => "/ap/test",
            'remember_token' => Str::random(10),
        ]);
        User::factory()->create([
            'login' => "vincent",
            'email' => "vincentModerateur@domain.fr",
            'email_verified_at' => now(),
            'password' => Hash::make('UnSecret'),
            'valide' => true,
            'nom' => "vincent",
            'prenom' => "vinz",
            'pseudo' => "das",
            'avatar' => "/ap/test",
            'remember_token' => Str::random(10),
        ]);
        User::factory()->create([
            'login' => "vincent",
            'email' => "vincentAdherentPrem@domain.fr",
            'email_verified_at' => now(),
            'password' => Hash::make('UnSecret'),
            'valide' => true,
            'nom' => "vincent",
            'prenom' => "vinz",
            'pseudo' => "das",
            'avatar' => "/ap/test",
            'remember_token' => Str::random(10),
        ]);
        User::factory()->create([
            'login' => "vincent",
            'email' => "vincentAdherent@domain.fr",
            'email_verified_at' => now(),
            'password' => Hash::make('UnSecret'),
            'valide' => true,
            'nom' => "vincent",
            'prenom' => "vinz",
            'pseudo' => "das",
            'avatar' => "/ap/test",
            'remember_token' => Str::random(10),
        ]);
        User::factory()->create([
            'login' => "vincent",
            'email' => "vincentVisitor@domain.fr",
            'email_verified_at' => now(),
            'password' => Hash::make('UnSecret'),
            'valide' => true,
            'nom' => "vincent",
            'prenom' => "vinz",
            'pseudo' => "das",
            'avatar' => "/ap/test",
            'remember_token' => Str::random(10),
        ]);
    }
}
