<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BetSlip;
use App\Models\Prediction;

class PredictionsController extends Controller
{
    public function predictions()
{

    // CHECK IF ENABLED
    if (setting('predictions_enabled') == 0) {
        abort(403, 'Predictions are currently disabled by system admin please try again later.');
    }

    // GET LIMIT
    $limit = setting('max_predictions_per_day') ?? 10;

    // LOAD DATA WITH LIMIT
    $betSlips = BetSlip::with('predictions')
        ->latest()
        ->take($limit)
        ->get();

    // EXPIRY LOGIC
    $expiry = setting('prediction_expiry_hours') ?? 24;

    foreach ($betSlips as $betSlip) {
        foreach ($betSlip->predictions as $prediction) {

            if (now()->diffInHours($prediction->created_at) >= $expiry) {
                $prediction->status = 'expired';
            }

        }
    }

    return view('frontend.predictions', compact('betSlips'));
}
}