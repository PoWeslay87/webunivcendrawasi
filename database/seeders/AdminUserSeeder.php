<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user admin jika belum ada
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password123') // ganti password sesuai keinginan
            ]
        );

        // Assign role admin
        $admin->assignRole('admin');
    }
}
