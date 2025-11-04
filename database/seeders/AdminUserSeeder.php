<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@cinerama.com'],
            [
                'name' => 'Admin Cinerama',
                'password' => Hash::make('Admin#123'),
                'is_admin' => true,
            ]
        );
    }
}
