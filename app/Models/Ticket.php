<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {
    use HasFactory;
    protected $fillable = ['movie_id','cinema_id','user_id','show_date','qty','price_total'];
    protected $casts = ['show_date'=>'date','price_total'=>'decimal:2'];
    public function movie(){ return $this->belongsTo(Movie::class); }
}
