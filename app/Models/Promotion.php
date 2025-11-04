<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = ['title','image','discount_text','valid_until'];
    protected $casts = ['valid_until' => 'date'];
}

