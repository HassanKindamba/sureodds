<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Founder extends Model
{
    protected $fillable = [
        'name',
        'role',
        'email',
        'phone',
        'image'
    ];
}
