<?php
// app/Models/Session.php

namespace App\Models;
use App\Models\CallLink;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'course', 
        'datetime',
        'description',
        'plan_type',
        'duration_minutes'
    ];

    protected $casts = [
        'datetime' => 'datetime'
    ];

    // Relation avec les liens d'appel
    public function callLink()
    {
        return $this->hasOne(CallLink::class)->where('is_active', true);
    }
}