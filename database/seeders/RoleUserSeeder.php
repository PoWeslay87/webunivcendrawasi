<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleUserSeeder extends Seeder
{
    public function run()
    {
        // 👇 STEP 1: Buat role jika belum ada (aman, tidak duplikat)
        $roles = ['admin', 'editor', 'user'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // 👇 STEP 2: Buat user admin — cek dulu apakah sudah ada
        $admin = User::firstOrCreate(
            ['email' => 'admin@universitas.ac.id'],
            [
                'name' => 'Admin Utama',
                'password' => bcrypt('password'),
            ]
        );
        $admin->assignRole('admin');

        // 👇 STEP 3: Buat user editor — cek dulu
        $editor = User::firstOrCreate(
            ['email' => 'editor@universitas.ac.id'],
            [
                'name' => 'Editor Konten',
                'password' => bcrypt('password'),
            ]
        );
        $editor->assignRole('editor');

        // 👇 STEP 4: Buat user biasa — cek dulu
        $pengguna = User::firstOrCreate(
            ['email' => 'pengguna@universitas.ac.id'],
            [
                'name' => 'Pengguna Biasa',
                'password' => bcrypt('password'),
            ]
        );
        $pengguna->assignRole('user');

        // 💡 Catatan: `firstOrCreate()` akan:
        // - Cari user berdasarkan email
        // - Kalau ada → skip, tidak error
        // - Kalau belum ada → buat baru
    }
}