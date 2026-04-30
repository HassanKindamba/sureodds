<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    protected $fillable = [
        'bet_slip_id',
        'match',
        'league',
        'match_date',
        'match_time',
        'prediction',
        'odds',
    ];

    // 👇 HII NDIO UNAWEKA HAPA
    public function betSlip()
    {
        return $this->belongsTo(BetSlip::class);
    }
}