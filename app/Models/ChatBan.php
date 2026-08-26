<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatBan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'blocked_by',
        'reason',
        'blocked_at',
        'expires_at',
    ];

    protected $casts = [
        'blocked_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blockedBy()
    {
        return $this->belongsTo(User::class, 'blocked_by');
    }
}