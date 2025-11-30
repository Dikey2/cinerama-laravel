<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('seat_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('showtime_id')->constrained()->onDelete('cascade');
            $table->string('seat'); // A1, B10, etc.
            $table->enum('status', ['reserved', 'paid'])->default('reserved');
            $table->string('session_id')->nullable(); // Para invitados
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();

            $table->unique(['showtime_id', 'seat']); // una butaca solo una vez
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seat_reservations');
    }
};
