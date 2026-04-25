<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $fillable = [
        'title',
        'description',

        'stat_accuracy_label',
        'stat_accuracy_value',

        'stat_members_label',
        'stat_members_value',

        'stat_picks_label',
        'stat_picks_value',

        'stat_experience_label',
        'stat_experience_value',

        'image',
    ];
}