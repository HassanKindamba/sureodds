<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\PredictionFeedback;

class FeedbackController extends Controller
{
    /**
     * Display all user feedback.
     */
    public function index()
    {
        $feedbacks = PredictionFeedback::with([
            'user',
            'prediction',
            'betSlip'
        ])
        ->latest()
        ->paginate(20);

        return view(
            'admin.manager.feedback.index',
            compact('feedbacks')
        );
    }

    public function destroy(PredictionFeedback $feedback)
    {
        $feedback->delete();

        return back()->with('success', 'Feedback imefutwa successfully.');
    }
}