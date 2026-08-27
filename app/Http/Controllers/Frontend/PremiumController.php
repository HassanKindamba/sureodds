<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;

class PremiumController extends Controller
{
    public function premium()
    {
        // 1. Inachukua mipango yote yenye status true na kuipanga kuanzia bei ndogo (Wiki) kwenda kubwa (Mwezi)
        $plans = SubscriptionPlan::where('status', true)
                                  ->orderBy('price', 'asc')
                                  ->get();

        return view('frontend.premium', compact('plans'));
    }
}