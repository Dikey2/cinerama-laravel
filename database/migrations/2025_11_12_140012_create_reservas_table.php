<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->string('pelicula');
            $table->string('cine');
            $table->string('ciudad');
            $table->string('hora');
            $table->string('butaca');
            $table->enum('estado', ['reservada', 'ocupada'])->default('reservada');
            $table->timestamp('reservado_hasta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
