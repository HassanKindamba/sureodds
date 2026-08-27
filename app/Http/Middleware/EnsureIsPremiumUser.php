<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Subscription;
use Carbon\Carbon;

class EnsureIsPremiumUser
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Angalia kama mteja ana subscription yoyote yenye status active na haija-expire
        $hasActiveSubscription = Subscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->where('expires_at', '>', Carbon::now())
            ->exists();

        if (!$hasActiveSubscription) {
            return redirect()->route('payments.index')
                ->with('error', 'Unatakiwa kulipia kifurushi ili kuona VIP Odds.');
        }

        return $next($request);
    }
}