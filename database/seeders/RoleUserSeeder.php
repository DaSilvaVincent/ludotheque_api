<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $user = User::findOrFail($i);
            for ($j = $i; $j <= 5; $j++)
                $user->roles()->attach($j);
            $user->save();
        }
        $vincentAdmin = User::findOrFail(11);
        $vincentAdmin->roles()->attach([5,4,3,2,1]);
        $vincentAdmin->save();
        $vincentModerateur = User::findOrFail(12);
        $vincentModerateur->roles()->attach([5,4,3,2]);
        $vincentModerateur->save();
        $vincentAdherentPrem = User::findOrFail(13);
        $vincentAdherentPrem->roles()->attach([5,4,3]);
        $vincentAdherentPrem->save();
        $vincentAdherent = User::findOrFail(14);
        $vincentAdherent->roles()->attach([5,4]);
        $vincentAdherent->save();
        $vincentVisiteur = User::findOrFail(15);
        $vincentVisiteur->roles()->attach([5]);
        $vincentVisiteur->save();
    }
}
