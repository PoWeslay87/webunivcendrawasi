<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\PesanKontak;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Kartu metrik
        $metrics = [
            'users'       => User::count(),
            'roles'       => Role::count(),
            'permissions' => Permission::count(),
            'posts'       => Post::count(),
            'inbox'       => PesanKontak::count(),
        ];

        // Daftar terbaru
        $recentPosts   = Post::latest()->take(5)->get(['id','judul','kategori','created_at']);
        $recentInbox   = PesanKontak::latest()->take(5)->get(['id','nama','email','created_at']);

        // Chart: Post per bulan (6 bulan terakhir, pakai created_at saja agar simpel)
        $months = collect(range(5,0))->map(fn($i) => now()->subMonths($i)->startOfMonth());
        $postLabels = $months->map(fn($m) => $m->translatedFormat('M Y'));
        $postSeries = $months->map(function($start){
            $end = (clone $start)->endOfMonth();
            return Post::whereBetween('created_at', [$start, $end])->count();
        });

        // Chart: sebaran permission per modul (ambil kata terakhir: posts/users/roles/permissions)
        $permByModule = Permission::all()
            ->groupBy(function($p){
                $parts = preg_split('/\s+/', $p->name);
                return strtolower(end($parts)); // contoh: "view posts" -> "posts"
            })
            ->map->count();

        // Chart: 5 role dengan user terbanyak
        $rolesTop = Role::withCount('users')->orderByDesc('users_count')->take(5)->get(['name','users_count']);

        return view('admin.dashboard', [
            'metrics'       => $metrics,
            'recentPosts'   => $recentPosts,
            'recentInbox'   => $recentInbox,
            'postLabels'    => $postLabels,
            'postSeries'    => $postSeries,
            'permByModule'  => $permByModule,
            'rolesTop'      => $rolesTop,
        ]);
    }
}
