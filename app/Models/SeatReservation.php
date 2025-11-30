<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeatReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'showtime_id', 'seat', 'status', 'session_id', 'user_id',
    ];

    public function showtime()
    {
        return $this->belongsTo(Showtime::class);
    }
}
