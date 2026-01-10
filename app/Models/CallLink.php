<?php
// app/Models/CallLink.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'platform',
        'meeting_id',
        'meeting_password',
        'join_url',
        'is_active'
    ];

    // Relation avec la session
    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}