<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:posts_view',   only: ['index']),
            new Middleware('permission:posts_create', only: ['create','store']),
            new Middleware('permission:posts_edit',   only: ['edit','update']),
            new Middleware('permission:posts_delete', only: ['destroy']),
            new Middleware('permission:posts_create|posts_edit', only: ['uploadImage']),
        ];
    }

    // GET /admin/posts
    public function index()
    {
        $posts = Post::with(['user'])
            ->orderByRaw('COALESCE(tanggal, created_at) DESC')
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    // GET /admin/posts/create
    public function create()
    {
        return view('admin.posts.create');
    }

    // POST /admin/posts
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'    => ['required','string','unique:posts,judul','min:3'],
            'isi'      => ['required','string'],
            'kategori' => ['nullable','string','max:255'],
            'tanggal'  => ['required','date'],
            'gambar'   => ['nullable','image','mimes:jpg,jpeg,png','max:2048'],
            'status'   => ['required','in:draft,published']
        ]);

        // TAMBAHKAN INI — GANTI &nbsp; JADI SPASI BIASA
        $data['isi'] = str_replace('&nbsp;', ' ', $data['isi']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('posts', 'public');
        }

        $data['slug'] = Str::slug($data['judul']);
        $data['user_id'] = auth()->id();

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil dibuat');
    }

    // GET /admin/posts/{post}/edit — AUTO BINDING!
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    // PUT /admin/posts/{post} — AUTO BINDING!
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'judul'    => ['required','string','min:3'],
            'isi'      => ['required','string'],
            'kategori' => ['nullable','string','max:255'],
            'tanggal'  => ['nullable','date'],
            'gambar'   => ['nullable','image','mimes:jpg,jpeg,png','max:2048'],
            'status'   => ['required','in:draft,published']
        ]);

        // TAMBAHKAN INI — GANTI &nbsp; JADI SPASI BIASA
        $data['isi'] = str_replace('&nbsp;', ' ', $data['isi']);

        if ($request->hasFile('gambar')) {
            if ($post->gambar && Storage::disk('public')->exists($post->gambar)) {
                Storage::disk('public')->delete($post->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Artikel berhasil diperbarui');
    }

    // DELETE /admin/posts/{post} — AUTO BINDING!
    public function destroy(Post $post)
    {
        if ($post->gambar && Storage::disk('public')->exists($post->gambar)) {
            Storage::disk('public')->delete($post->gambar);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Artikel dihapus');
    }

    // Upload gambar untuk Summernote
    public function uploadImage(Request $request)
    {
        $field = $request->hasFile('file') ? 'file' : 'image';

        $request->validate([
            $field => ['required','image','mimes:jpg,jpeg,png,gif,webp','max:5120'],
        ]);

        $path = $request->file($field)->store('posts/inline', 'public');
        $url  = Storage::disk('public')->url($path);

        return response()->json([
            'url' => $url,
            'path' => $path,
        ]);
    }
}