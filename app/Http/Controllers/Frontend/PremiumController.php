<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;

class PremiumController extends Controller
{
    public function premium()
    {
        $plans = SubscriptionPlan::where('status', true)->get();

        return view('frontend.premium', compact('plans'));
    }
}