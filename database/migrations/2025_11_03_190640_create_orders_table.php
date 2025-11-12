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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_name')->nullable(); // Nombre del cliente
            $table->string('email')->nullable();      // Correo del cliente
            $table->string('phone')->nullable();      // Teléfono del cliente
            $table->decimal('total', 10, 2)->default(0); // Total del pedido
            $table->string('codigo', 30)->nullable(); // 🟡 Código único del pedido
            $table->timestamps();                     // created_at / updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
