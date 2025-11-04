namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo', 'nombre_cliente', 'correo_cliente', 'telefono_cliente', 'total', 'estado'
    ];

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }
}

