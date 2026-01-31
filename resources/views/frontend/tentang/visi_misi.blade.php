{{-- resources/views/frontend/tentang/visi_misi.blade.php --}}
@extends('layouts.frontend')

@section('title', 'Visi & Misi')

@section('content')
  {{-- biarkan padding top sesuai layout existing --}}
  <div class="pt-24"></div>

  <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 py-6 lg:py-10">
    {{-- Hero elegan dengan warna biru→indigo→ungu --}}
    <section
      class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-900 via-indigo-800 to-purple-900 p-8 lg:p-12 mb-6 lg:mb-10 text-white">
      <div class="pointer-events-none absolute inset-0 opacity-20 mix-blend-screen">
        <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <pattern id="grid" width="32" height="32" patternUnits="userSpaceOnUse">
              <path d="M 32 0 L 0 0 0 32" fill="none" stroke="white" stroke-opacity=".1"/>
            </pattern>
          </defs>
          <rect width="100%" height="100%" fill="url(#grid)"/>
        </svg>
      </div>
      <div class="relative">
        <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-xs font-medium ring-1 ring-inset ring-white/20">
          Universitas Papua
        </span>
        <h1 class="mt-3 text-3xl lg:text-5xl font-bold tracking-tight">Visi &amp; Misi</h1>
        <p class="mt-2 max-w-3xl text-sm lg:text-base text-slate-100">
          Arah strategis dan tujuan utama UNCEN untuk masa depan pendidikan di Tanah Papua.
        </p>
      </div>
    </section>

    {{-- Kartu konten --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      {{-- Visi --}}
      <div class="rounded-2xl border border-indigo-200 bg-white shadow-xl shadow-indigo-100/50 ring-1 ring-indigo-100/60">
        <div class="p-6 lg:p-8">
          <div class="flex items-start gap-3 mb-4">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-indigo-100 ring-1 ring-indigo-200">
              <svg class="h-5 w-5 text-indigo-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                   stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6v6l4 2m6 2a10 10 0 11-20 0 10 10 0 0120 0z"/>
              </svg>
            </div>
            <h2 class="text-xl lg:text-2xl font-bold text-indigo-900">Visi</h2>
          </div>

          @if ($data && $data->visi)
            <article
              class="prose prose-slate max-w-none lg:prose-lg leading-relaxed selection:bg-purple-100 selection:text-slate-900">
              {!! nl2br(e($data->visi)) !!}
            </article>
          @else
            <div class="rounded-xl border border-dashed border-indigo-300/80 bg-indigo-50 p-6 text-center">
              <h3 class="text-base font-semibold text-indigo-900">Visi belum ditentukan</h3>
              <p class="mt-1 text-sm text-indigo-700">Silakan tambahkan melalui dasbor untuk menampilkan visi UNIPA.</p>
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

      {{-- Misi --}}
      <div class="rounded-2xl border border-purple-200 bg-white shadow-xl shadow-purple-100/50 ring-1 ring-purple-100/60">
        <div class="p-6 lg:p-8">
          <div class="flex items-start gap-3 mb-4">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-purple-100 ring-1 ring-purple-200">
              <svg class="h-5 w-5 text-purple-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                   viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4.5 6.75l7.5 7.5 7.5-7.5M4.5 12.75l7.5 7.5 7.5-7.5"/>
              </svg>
            </div>
            <h2 class="text-xl lg:text-2xl font-bold text-purple-900">Misi</h2>
          </div>

          @if ($data && $data->misi)
            <article
              class="prose prose-slate max-w-none lg:prose-lg leading-relaxed selection:bg-blue-100 selection:text-slate-900">
              {!! nl2br(e($data->misi)) !!}
            </article>
          @else
            <div class="rounded-xl border border-dashed border-purple-300/80 bg-purple-50 p-6 text-center">
              <h3 class="text-base font-semibold text-purple-900">Misi belum ditentukan</h3>
              <p class="mt-1 text-sm text-purple-700">Silakan tambahkan melalui dasbor untuk menampilkan misi UNIPA.</p>
              <div class="mt-4">
                <a href="{{ url('/dashboard') }}"
                   class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-900 via-indigo-800 to-purple-900 px-3.5 py-2 text-sm font-medium text-white shadow-lg hover:opacity-90 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-purple-700">
                  Buka Dasbor
                </a>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>

    {{-- meta kecil --}}
    @if (!empty($data?->updated_at))
      <div class="mt-6 text-sm text-slate-500">
        Terakhir diperbarui:
        <span class="font-medium text-indigo-700">
          {{ \Carbon\Carbon::parse($data->updated_at)->translatedFormat('d F Y') }}
        </span>
      </div>
    @endif
  </div>
@endsection
