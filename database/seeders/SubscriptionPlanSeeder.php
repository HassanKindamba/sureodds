<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubscriptionPlan;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubscriptionPlan::create([
            'name' => 'Basic',
            'price' => 5000,
            'duration_days' => 7,
        ]);

        SubscriptionPlan::create([
            'name' => 'Pro',
            'price' => 15000,
            'duration_days' => 30,
        ]);

        SubscriptionPlan::create([
            'name' => 'VIP',
            'price' => 40000,
            'duration_days' => 30,
        ]);
    }
}