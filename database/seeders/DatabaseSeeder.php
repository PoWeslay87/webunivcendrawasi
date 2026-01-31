<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan seeder Role & Permission
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class, // tambah ini
        ]);
        

        $this->call(UserPenggunaSeeder::class);
        // Kalau mau jalankan seeder lain tinggal tambahkan di sini, contoh:
        // $this->call(UserSeeder::class);
        // $this->call(ProgramStudiSeeder::class);
    }
}
