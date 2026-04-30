<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BetSlip;

class PredictionsController extends Controller
{
    public function predictions()
    {
        $betSlips = BetSlip::with('predictions')
            ->latest()
            ->get();

        return view('frontend.predictions', compact('betSlips'));
    }
}
