<?php

namespace Database\Seeders;

use App\Models\SeedType;
use Illuminate\Database\Seeder;

class SeedTypeSeeder extends Seeder
{
    public function run(): void
    {
        SeedType::updateOrCreate(
            ['name' => 'Normal'],
            ['cares_per_level' => 5, 'harvest_reward' => 10]
        );

        SeedType::updateOrCreate(
            ['name' => 'Rápida'],
            ['cares_per_level' => 3, 'harvest_reward' => 7]
        );
    }
}
