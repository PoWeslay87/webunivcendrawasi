<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\PesanKontak;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // badge jumlah pesan di navbar admin
        View::composer('layouts.admin', function ($view) {
            $view->with('kontakCount', PesanKontak::count());
        });
    }
}