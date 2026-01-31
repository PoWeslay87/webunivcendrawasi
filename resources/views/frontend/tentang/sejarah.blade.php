{{-- resources/views/frontend/tentang/sejarah.blade.php --}}
@extends('layouts.frontend')
@section('title', 'Sejarah Universitas Papua')

@section('content')
  {{-- biarkan padding top sesuai layout existing --}}
  <div class="pt-24"></div>

  <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 py-6 lg:py-10">
    {{-- Hero elegan selaras dengan Visi & Misi --}}
    <section
      class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-900 via-indigo-800 to-purple-900 p-8 lg:p-12 mb-6 lg:mb-10 text-white">

      {{-- pola lembut --}}
      <div class="pointer-events-none absolute inset-0 opacity-20 mix-blend-screen">
        <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <pattern id="grid" width="32" height="32" patternUnits="userSpaceOnUse">
              <path d="M 32 0 L 0 0 0 32" fill="none" stroke="white" stroke-opacity=".08"/>
            </pattern>
          </defs>
          <rect width="100%" height="100%" fill="url(#grid)"/>
        </svg>
      </div>

      <div class="relative">
        <span
          class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-xs font-medium ring-1 ring-inset ring-white/20">
          Universitas Cenderawasi
        </span>
        <h1 class="mt-3 text-3xl lg:text-5xl font-bold tracking-tight">
          Sejarah Universitas Papua
        </h1>
        <p class="mt-2 max-w-3xl text-sm lg:text-base text-slate-100">
          Menelusuri perjalanan, tonggak, dan peran UNCEN bagi Tanah Papua.
        </p>
      </div>
    </section>

    {{-- Kartu konten --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-200/50 ring-1 ring-slate-100/60">
      <div class="p-5 sm:p-7 lg:p-9">
        @if ($data && $data->sejarah)
          <article
            class="prose prose-slate max-w-none lg:prose-lg leading-relaxed
                   selection:bg-amber-100 selection:text-slate-900
                   [&>p:first-child::first-letter]:float-left
                   [&>p:first-child::first-letter]:text-5xl
                   [&>p:first-child::first-letter]:font-bold
                   [&>p:first-child::first-letter]:leading-[.9]
                   [&>p:first-child::first-letter]:mr-3
                   [&>p:first-child::first-letter]:px-2
                   [&>p:first-child::first-letter]:rounded-md
                   [&>p:first-child::first-letter]:bg-slate-100
                   [&>p:first-child::first-letter]:text-slate-900">
            {!! nl2br(e($data->sejarah)) !!}
          </article>

          {{-- meta kecil --}}
          <div class="mt-6 pt-6 border-t border-slate-100 flex flex-wrap items-center gap-x-3 gap-y-2 text-sm text-slate-500">
            @if (!empty($data->updated_at))
              <span>Terakhir diperbarui:
                <span class="font-medium text-slate-700">
                  {{ \Carbon\Carbon::parse($data->updated_at)->translatedFormat('d F Y') }}
                </span>
              </span>
            @endif
            <span class="hidden sm:inline">•</span>
            <span>Kurasi: Humas UNCEN</span>
          </div>
        @else
          <div class="rounded-xl border border-dashed border-slate-300/80 bg-slate-50 p-8 text-center">
            <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-white shadow-sm ring-1 ring-slate-200">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-500" fill="none"
                   viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4 6h10l2 2h4v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6z"/>
              </svg>
            </div>
            <h3 class="text-base font-semibold text-slate-900">Belum ada data sejarah</h3>
            <p class="mt-1 text-sm text-slate-600">
              Silakan tambahkan konten melalui dasbor untuk menampilkan riwayat UNIPA.
            </p>
            <div class="mt-4">
              <a href="{{ url('/dashboard') }}"
                 class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-900 via-indigo-800 to-purple-900 px-3.5 py-2 text-sm font-medium text-white shadow-lg hover:opacity-90 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-indigo-700">
                Buka Dasbor
              </a>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection
