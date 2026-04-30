<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Home; // 👈 HAPA NDIPO SAHIHI
use Illuminate\Http\Request;
use App\Models\BetSlip;

class HomeController extends Controller
{
    public function index()
        {
            $home = Home::first();

            $betSlips = BetSlip::with('predictions')
            ->latest()
            ->take(5) // optional: show latest 5
            ->get();

            return view('frontend.home', compact('home', 'betSlips'));
        }
}
