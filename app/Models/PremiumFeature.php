<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PremiumFeature extends Model
{
    protected $fillable = [
        'key',
        'name',
        'enabled'
    ];
}
