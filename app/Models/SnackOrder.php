<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Showtime extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id', 'cinema_id', 'show_date', 'show_time',
        'format', 'language', 'room', 'price',
    ];

    protected $casts = [
        'show_date' => 'date',
        'show_time' => 'datetime:H:i',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    public function seatReservations()
    {
        return $this->hasMany(SeatReservation::class);
    }
}

