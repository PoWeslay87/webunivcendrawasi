<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot(): void
    {
        // 👇 HANYA ADMIN YANG BOLEH BYPASS SEMUA PERMISSION
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('admin')) {
                return true; // ✅ Admin bisa akses semua
            }
            return null; // 👈 Biarkan sistem cek permission biasa
        });

        // 👇 Opsional: Daftarkan policy jika kamu punya
        // $this->registerPolicies();
    }
}