{{-- resources/views/frontend/posts/show.blade.php --}}
@extends('layouts.frontend')

@section('content')
    <section class="pt-28 pb-12 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6">

            {{-- Meta: tanggal & kategori (dengan ikon) --}}
            <div class="flex items-center gap-3 text-sm text-gray-500 mb-5">
                <span class="flex items-center">
                    <i class="bi bi-calendar-date me-1">🗓️</i>
                    {{ \Illuminate\Support\Carbon::parse($post->tanggal)->format('d M Y') ?? (\Illuminate\Support\Carbon::parse($post->created_at)->format('d M Y') ?? '-') }}
                </span>

                @if($post->kategori)
                    <span class="flex items-center px-2 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-medium">
                        <i class="bi bi-bookmark me-1"></i>
                        {{ $post->kategori }}
                    </span>
                @endif
            </div>

            {{-- Judul --}}
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 leading-tight">
                {{ $post->judul }}
            </h1>

            {{-- Gambar (jika ada) --}}
            @if($post->gambar)
                <img src="{{ asset('storage/' . $post->gambar) }}"
                     alt="{{ $post->judul }}"
                     class="w-full rounded-xl shadow-md mb-8 object-cover max-h-[420px]">
            @endif

            {{-- Isi artikel (HTML dari Summernote) — hilangkan &nbsp; --}}
            <div class="prose max-w-none prose-img:rounded-lg prose-a:text-indigo-600 prose-headings:font-bold">
                {!! str_replace('&nbsp;', ' ', $post->isi) !!}
                {{-- Kalau ingin sanitasi HTML, install mews/purifier lalu gunakan:
                {!! \Mews\Purifier\Facades\Purifier::clean($post->isi) !!} --}}
            </div>

            {{-- Aksi bawah --}}
            <div class="mt-12">
                <a href="{{ route('posts.index') }}"
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 hover:text-indigo-700 transition-all duration-300 ease-in-out shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Daftar Artikel
                </a>
            </div>

        </div>
    </section>
@endsection