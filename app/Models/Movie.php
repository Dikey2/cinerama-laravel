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
        'poster',
        'image',
        'release_date',
        'genre',
        'duration',
        'classification',
        'format',
        'language',
        'city',
        'synopsis',
        'schedules',
        'trailer_url'
    ];

protected $casts = [
    'schedules' => 'array',
];

}
