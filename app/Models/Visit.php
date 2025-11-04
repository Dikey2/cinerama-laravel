<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model {
    use HasFactory;
    protected $fillable = ['page','visited_at'];
    protected $casts = ['visited_at'=>'datetime'];
}
