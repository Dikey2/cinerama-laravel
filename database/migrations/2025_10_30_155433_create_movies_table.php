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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');                // Título de la película
            $table->text('description')->nullable(); // Sinopsis (opcional)
            $table->string('poster')->nullable();    // Imagen
            $table->date('release_date');            // Fecha de estreno (requerida)
            $table->string('genre');                 // Género
            $table->timestamps();                    // created_at / updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};

