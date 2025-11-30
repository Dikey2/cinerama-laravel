<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',          // Nombre del cine (ej. "Cinerama Alcázar")
        'city',          // Ciudad donde se encuentra
        'address',       // Dirección exacta
        'phone',         // Teléfono
        'capacity',      // Capacidad total del cine (opcional)
    ];

    // 👇 Relación hacia los horarios de películas
    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }

    // 👇 Relación inversa para obtener películas en este cine
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'showtimes');
        // porque showtimes tiene movie_id y cinema_id
    }
}


