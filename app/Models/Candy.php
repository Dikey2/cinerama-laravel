<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candy extends Model
{
    use HasFactory;
    protected $fillable = ['name','price','image'];
    protected $casts = ['price' => 'decimal:2'];
}

