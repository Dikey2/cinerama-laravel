<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'showtime_id', 'user_id', 'seats', 'total', 'code', 'status',
    ];

    protected $casts = [
        'seats' => 'array',
    ];

    public function showtime()
    {
        return $this->belongsTo(Showtime::class);
    }
}

