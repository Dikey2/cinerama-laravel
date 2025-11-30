<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('showtimes', function (Blueprint $table) {
            $table->id();

            // Relaciones con películas y cines
            $table->foreignId('movie_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('cinema_id')
                ->constrained()
                ->onDelete('cascade');

            // Fecha y hora de la función
            $table->date('date');           // fecha obligatoria
            $table->time('time');           // hora exacta

            // Información adicional
            $table->string('room')->nullable();           // sala opcional
            $table->string('format')->default('2D');      // 2D / 3D / XD...
            $table->string('language')->default('DOB');   // DOB / SUB
            $table->decimal('price', 8, 2)->default(0);   // precio de la función

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('showtimes');
    }
};


