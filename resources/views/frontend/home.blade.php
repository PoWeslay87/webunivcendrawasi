<!-- /resources/views/frontend/home.blade.php -->
@extends('layouts.frontend')
<title>Website Universitas Cendrawasi Jayapura</title>
@section('content')
<div class="section">
 <section class="relative bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 text-white pt-44 pb-28 overflow-hidden mt-16">
    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
    <div class="relative max-w-6xl mx-auto px-6 text-center z-10 animate-fade-in-up">
        <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight drop-shadow-lg">
            🌟 Selamat Datang di Universitas <span class="text-yellow-300">Cendrawasi Papua</span>
        </h1>
        <p class="text-lg md:text-xl text-gray-200 max-w-3xl mx-auto">
            Tempat terbaik untuk meraih masa depan gemilang melalui pendidikan yang unggul dan inspiratif di Papua Tengah.
        </p>
        <div class="mt-8">
            <a href="{{route ('home')}}" class="bg-yellow-400 text-black font-semibold px-6 py-3 rounded-full hover:bg-yellow-500 transition duration-300">
                🎓 Jelajahi Kampus Kami
            </a>
        </div>
    </div>
</section>
</div>

<div class="pt-24"></div>


<style>
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 1s ease-out forwards;
    }
</style>

{{-- Cuplikan di home.blade.php --}}
<section class="bg-slate-50 py-10 sm:py-14">
    <div class="mx-auto w-full max-w-6xl px-4 sm:px-6">
        <div class="grid grid-cols-1 gap-8 text-center sm:grid-cols-3">
            @forelse($stats as $s)
                @php $num = number_format((int)$s->value, 0, ',', '.'); @endphp
                <div class="p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 transform hover:-translate-y-1">
                    <h3 class="text-2xl font-extrabold text-slate-900">
                        {{ $num }}{{ $s->suffix }} {{ $s->label }}
                    </h3>
                    @if($s->description)
                        <p class="mt-3 text-slate-600 max-w-sm mx-auto text-sm">
                            {{ $s->description }}
                        </p>
                    @endif
                </div>
            @empty
                <div class="col-span-3 text-slate-500">
                    Belum ada data statistik.
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="py-12 px-6 max-w-6xl mx-auto">
    <h2 class="text-2xl md:text-3xl font-bold mb-8 text-center text-gray-800">📄 Artikel Terbaru</h2>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($posts as $post)
            @php
                $full = trim(strip_tags($post->isi));
                $short = \Illuminate\Support\Str::limit($full, 160);
            @endphp

            <article class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full">
                @if ($post->gambar)
                    <img src="{{ asset('storage/' . $post->gambar) }}" 
                         alt="{{ $post->judul }}" 
                         class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                        <span class="text-gray-400 text-sm">Tidak ada gambar</span>
                    </div>
                @endif

                <div class="p-5 flex-grow flex flex-col">
                    <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                        <span class="flex items-center">
                            <i class="bi bi-calendar me-1">🗓️</i>
                            {{ \Illuminate\Support\Carbon::parse($post->tanggal)->format('d M Y') ?? (\Illuminate\Support\Carbon::parse($post->created_at)->format('d M Y') ?? '-') }}
                        </span>
                        @if($post->kategori)
                            <span class="px-2 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-medium">
                                {{ $post->kategori }}
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <span class="text-sm text-gray-600">
                            <i class="bi bi-person-circle me-1"></i>
                            {{ optional($post->user)->name ?? 'Penulis Tidak Diketahui' }}
                        </span>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-900 mb-3 line-clamp-2">
                        <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-indigo-600 hover:underline">
                            {{ $post->judul }}
                        </a>
                    </h3>

                    <p class="text-sm text-gray-700 mb-4 flex-grow">
                        {{ $short }}
                    </p>

                  <div class="flex justify-center mt-4">
                    <a href="{{ route('posts.show', $post->slug) }}"
                     class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow-md hover:bg-indigo-700 hover:shadow-lg transition-all duration-300 ease-in-out">
                      Baca Selengkapnya
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 ml-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                   </svg>
                   </a>
                  </div>
                </div>
            </article>
        @empty
            <div class="col-span-3 text-center py-12 text-gray-500">
                <i class="bi bi-file-earmark-text-fill text-4xl mb-3 opacity-50"></i>
                <p class="text-lg">Belum ada artikel yang tersedia.</p>
            </div>
        @endforelse
    </div>
</section>
{{-- 
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.js-readmore').forEach(btn => {
    btn.addEventListener('click', () => {
      const card = btn.closest('article');
      const excerpt = card.querySelector('.js-excerpt');
      const full    = card.querySelector('.js-full');
      const expanded = !full.classList.contains('hidden');

      if (expanded) {
        full.classList.add('hidden');
        excerpt.classList.remove('hidden');
        btn.textContent = 'Baca selengkapnya';
      } else {
        full.classList.remove('hidden');
        excerpt.classList.add('hidden');
        btn.textContent = 'Tutup';
      }
    });
  });
});
</script> --}}
@endsection