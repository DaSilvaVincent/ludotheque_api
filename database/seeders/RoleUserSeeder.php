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
        $vincent = User::findOrFail(11);
        $vincent->roles()->attach([4,3,2,1]);
        $vincent->save();
    }
}
