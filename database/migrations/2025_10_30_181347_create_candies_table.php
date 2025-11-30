<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candies', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre visible (Promo 1, Promo 2…)
            $table->string('descripcion')->nullable(); // Texto corto debajo del título
            $table->decimal('precio', 8, 2); // S/ 42.00
            $table->string('categoria')->default('promo'); 
            // promo, socio, combos1o2, canchitas, dulces, complementos

            $table->string('imagen')->nullable(); // Imagen del combo
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candies');
    }
};

