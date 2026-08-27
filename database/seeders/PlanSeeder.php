<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Plan ya Wiki
        Plan::updateOrCreate(
            ['name' => 'VIP Weekly'],
            [
                'price' => 10000, // Weka bei yako
                'duration_days' => 7,
            ]
        );

        // 2. Plan ya Mwezi
        Plan::updateOrCreate(
            ['name' => 'VIP Monthly'],
            [
                'price' => 30000, // Weka bei yako
                'duration_days' => 30,
            ]
        );
    }
}