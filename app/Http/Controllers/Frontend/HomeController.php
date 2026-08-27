<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Home; // 👈 HAPA NDIPO SAHIHI
use Illuminate\Http\Request;
use App\Models\BetSlip;
use App\Models\Plan;

class HomeController extends Controller
{
    public function index()
    {
        $home = Home::first();

if (!$home) {
    $home = new Home();
    $home->title = 'Welcome to Sure Odds';
    $home->description = 'Get the latest predictions and analysis.';
}

        $betSlips = BetSlip::with('predictions')
            ->latest()
            ->take(5)
            ->get();

        $plans = Plan::all(); // 🔥 ADD THIS

        return view('frontend.home', compact('home', 'betSlips', 'plans'));
    }
}
