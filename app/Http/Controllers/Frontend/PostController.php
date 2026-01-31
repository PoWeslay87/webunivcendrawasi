<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\SiteStat;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    // Halaman depan / list publik
    public function homepage()
    {
        $posts = Post::with(['user'])
            ->orderByRaw('COALESCE(tanggal, created_at) DESC')
            ->paginate(12);

        $stats = Cache::remember('site_stats_active', 60, function () {
            return SiteStat::where('is_active', true)
                ->orderBy('sort')
                ->get();
        });

        return view('frontend.home', compact('posts', 'stats'));
    }

    // Detail artikel publik
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('frontend.posts.show', compact('post'));
    }
}
