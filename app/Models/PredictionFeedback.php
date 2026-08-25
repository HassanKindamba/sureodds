<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PredictionFeedback extends Model
{
    protected $fillable = [
        'user_id',
        'prediction_id',
        'bet_slip_id',
        'rating',
        'comment',
    ];

    public function prediction()
    {
        return $this->belongsTo(Prediction::class);
    }

    public function betSlip()
    {
        return $this->belongsTo(BetSlip::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}