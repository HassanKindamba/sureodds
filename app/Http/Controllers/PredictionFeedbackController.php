<?php

namespace App\Http\Controllers;

use App\Models\Prediction;
use App\Models\PredictionFeedback;
use Illuminate\Http\Request;

class PredictionFeedbackController extends Controller
{
    public function store(Request $request, Prediction $prediction)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        PredictionFeedback::create([
            'user_id' => auth()->id(),
            'prediction_id' => $prediction->id,
            'bet_slip_id' => $prediction->bet_slip_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with(
            'feedback_success',
            'Asante! Feedback yako imepokelewa.'
        );
    }
}