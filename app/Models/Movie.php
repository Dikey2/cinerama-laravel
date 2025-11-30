<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',            // 🔥 imagen real
        'release_date',
        'genre',
        'duration',
        'classification',
        'format',
        'language',
        'city',
        'synopsis',
        'trailer_url'
    ];

    protected $casts = [
        'release_date' => 'datetime',
    ];

    // 🔥 Horarios reales desde la tabla showtimes
    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
}




