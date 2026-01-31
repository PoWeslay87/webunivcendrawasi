<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserPenggunaSeeder extends Seeder
{
    public function run()
    {
        // Buat role dulu
        $roles = ['admin', 'editor', 'user'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        //  Buat user admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@universitas.ac.id',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        //  Buat user editor
        $editor = User::create([
            'name' => 'Editor',
            'email' => 'editor@universitas.ac.id',
            'password' => bcrypt('password'),
        ]);
        $editor->assignRole('editor');

        //  Buat user biasa (pengguna)
        $pengguna = User::create([
            'name' => 'Pengguna Biasa',
            'email' => 'pengguna@universitas.ac.id',
            'password' => bcrypt('password'),
        ]);
        $pengguna->assignRole('user');
    }
}