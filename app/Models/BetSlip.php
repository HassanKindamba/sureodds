<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BetSlip extends Model
{
    protected $fillable = [
        'bet_code',
        'bookmaker',
        'total_odds',
        'betting_link',
    ];

    // 👇 HII NDIO UNAWEKA HAPA
    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }
}