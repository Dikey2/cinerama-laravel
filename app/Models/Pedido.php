<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'pedidos';

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'codigo',
        'nombre_cliente',
        'correo_cliente',
        'telefono_cliente',
        'total',
        'estado',
    ];

    // Laravel usa created_at y updated_at por defecto
    public $timestamps = true;

    // ✅ Scope para obtener los últimos pedidos
    public function scopeRecientes($query)
    {
        return $query->orderBy('created_at', 'desc')->take(5);
    }

    // ✅ Accesor para formatear el total en soles
    public function getTotalFormateadoAttribute()
    {
        return 'S/ ' . number_format($this->total, 2);
    }
}


