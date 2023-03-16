<?php

namespace Database\Seeders;

use App\Models\Achat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AchatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Achat::factory()->count(50)->create();
    }
}
