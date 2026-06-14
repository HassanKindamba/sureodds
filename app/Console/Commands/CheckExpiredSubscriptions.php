<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserSubscription;
use Carbon\Carbon;

class CheckExpiredSubscriptions extends Command
{
    protected $signature = 'subscriptions:check-expiry';
    protected $description = 'Check and expire subscriptions automatically';

    public function handle()
    {
        $now = Carbon::now();

        $expired = UserSubscription::where('status', 'active')
            ->where('expires_at', '<', $now)
            ->get();

        foreach ($expired as $subscription) {
            $subscription->update([
                'status' => 'expired'
            ]);
        }

        $this->info(count($expired) . ' subscriptions expired successfully.');
    }
}