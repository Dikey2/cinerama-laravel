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
        Schema::create('seat_locks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('showtime_id');
            $table->string('seat'); // Ejemplo: "B7"
            $table->string('session_id'); // Identifica al usuario en esa sesión temporal
            $table->timestamp('expires_at');

            $table->timestamps();

            // Evitar que dos personas reserven la misma butaca al mismo tiempo
            $table->unique(['showtime_id', 'seat']);

            // Llave foránea opcional (si tienes tabla showtimes)
            $table->foreign('showtime_id')
                  ->references('id')
                  ->on('showtimes')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seat_locks');
    }
};
