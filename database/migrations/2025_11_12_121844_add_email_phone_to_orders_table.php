<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'email')) {
                $table->string('email')->nullable()->after('user_name');
            }

            if (!Schema::hasColumn('orders', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['email', 'phone']);
        });
    }
};

