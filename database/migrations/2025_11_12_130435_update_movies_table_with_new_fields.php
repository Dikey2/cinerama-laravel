<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            // Solo se agregan si no existen
            if (!Schema::hasColumn('movies', 'image')) {
                $table->string('image')->nullable()->after('poster');
            }
            if (!Schema::hasColumn('movies', 'duration')) {
                $table->string('duration')->nullable()->after('genre');
            }
            if (!Schema::hasColumn('movies', 'classification')) {
                $table->string('classification')->nullable()->after('duration');
            }
            if (!Schema::hasColumn('movies', 'format')) {
                $table->string('format')->nullable()->after('classification');
            }
            if (!Schema::hasColumn('movies', 'language')) {
                $table->string('language')->nullable()->after('format');
            }
            if (!Schema::hasColumn('movies', 'city')) {
                $table->string('city')->nullable()->after('language');
            }
            if (!Schema::hasColumn('movies', 'synopsis')) {
                $table->text('synopsis')->nullable()->after('city');
            }
            if (!Schema::hasColumn('movies', 'schedules')) {
                $table->json('schedules')->nullable()->after('synopsis');
            }
        });
    }

    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn([
                'image', 'duration', 'classification', 'format',
                'language', 'city', 'synopsis', 'schedules'
            ]);
        });
    }
};
