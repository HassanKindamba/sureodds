<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PremiumFeature;

class PremiumFeatureSeeder extends Seeder
{
    public function run(): void
    {
        PremiumFeature::insert([
            [
                'key' => 'advanced_odds',
                'name' => 'Advanced Odds Prediction',
                'enabled' => true
            ],
            [
                'key' => 'early_access',
                'name' => 'Early Odds Access',
                'enabled' => true
            ],
            [
                'key' => 'vip_matches',
                'name' => 'VIP Only Matches',
                'enabled' => false
            ],
            [
                'key' => 'high_accuracy',
                'name' => 'High Accuracy Tips',
                'enabled' => true
            ],
            [
                'key' => 'no_ads',
                'name' => 'No Ads Experience',
                'enabled' => false
            ],
        ]);
    }
}