<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SnackOrder extends Model {
    use HasFactory;
    protected $fillable = ['user_id','total'];
    protected $casts = ['total'=>'decimal:2'];
}
