<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // ✅ necesario para claves foráneas
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre_cliente');
            $table->string('correo_cliente')->nullable();
            $table->string('telefono_cliente')->nullable();
            $table->decimal('total', 8, 2);
            $table->string('estado')->default('pendiente'); // pendiente, pagado, cancelado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};

