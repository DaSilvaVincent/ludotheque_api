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
            for ($j = $i; $j <= 4; $j++)
                $user->roles()->attach($j);
            $user->save();
        }
        $vincentAdmin = User::findOrFail(11);
        $vincentAdmin->roles()->attach([4,3,2,1]);
        $vincentAdmin->save();
        $vincentAdherentPrem = User::findOrFail(12);
        $vincentAdherentPrem->roles()->attach([4,3,2]);
        $vincentAdherentPrem->save();
        $vincentAdherent = User::findOrFail(13);
        $vincentAdherent->roles()->attach([4,3]);
        $vincentAdherent->save();
        $vincentVisiteur = User::findOrFail(14);
        $vincentVisiteur->roles()->attach([4]);
        $vincentVisiteur->save();
    }
}
