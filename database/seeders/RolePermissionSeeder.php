<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Daftar semua permission
        $permissions = [
            'univ_create','univ_edit','univ_delete','univ_view',
            'stats_create','stats_edit','stats_delete','stats_view',
            'prodi_create','prodi_edit','prodi_delete','prodi_view',
            'akre_create','akre_edit','akre_delete','akre_view',
            'posts_create','posts_edit','posts_delete','posts_view',
            'kontak_create','kontak_edit','kontak_delete','kontak_view',
            'roles_create','roles_edit','roles_delete','roles_view',
            'permissions_create','permissions_edit','permissions_delete','permissions_view',
            'users_create','users_edit','users_delete','users_view',
        ];

        // Buat permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat role admin & assign semua permission
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions($permissions);

        // Buat role user biasa & assign permission terbatas
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->syncPermissions(['univ_view','stats_view','prodi_view']);
    }
}
