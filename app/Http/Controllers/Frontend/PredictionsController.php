<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BetSlip;
use App\Models\Prediction;

class PredictionsController extends Controller
{
    public function predictions()
    {

        // 1. CHECK IF PREDICTIONS ARE ENABLED
        if (setting('predictions_enabled') == 0) {
            abort(403, 'Predictions are currently disabled by system admin please try again later.');
        }

        // 3. LOAD DATA
        $betSlips = BetSlip::with('predictions')
            ->latest()
            ->get();

        return view('frontend.predictions', compact('betSlips'));
    }
}