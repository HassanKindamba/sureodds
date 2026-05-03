<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['key' => 'daily_prediction_limit'],
            ['value' => '10']
        );

        Setting::updateOrCreate(
            ['key' => 'predictions_enabled'],
            ['value' => '1']
        );

        Setting::updateOrCreate(
            ['key' => 'premium_enabled'],
            ['value' => '1']
        );
    }
}