{{-- resources/views/frontend/akreditasi/index.blade.php --}}
@extends('layouts.frontend')

@section('title', 'Akreditasi Program Studi')

@section('content')
  {{-- spasi bawah navbar --}}
  <div class="pt-24"></div>

  <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 py-6 lg:py-10">
    {{-- HERO --}}
    <section
      class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-900 via-indigo-800 to-purple-900 p-8 lg:p-10 text-white mb-6 lg:mb-10">
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
        <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-xs font-medium ring-1 ring-inset ring-white/20">Universitas Papua</span>
        <h1 class="mt-3 text-3xl lg:text-5xl font-bold tracking-tight">Daftar Akreditasi Program Studi</h1>
        <p class="mt-2 max-w-3xl text-sm lg:text-base text-slate-100">Informasi jenjang, tahun penetapan, nilai, dan keterangan akreditasi.</p>
      </div>
    </section>

    {{-- CARD TABEL --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-200/50 ring-1 ring-slate-100/60">
      <div class="p-4 sm:p-6 lg:p-8">
        @if ($akreditasis->isEmpty())
          {{-- EMPTY STATE --}}
          <div class="text-center rounded-xl border border-dashed border-slate-300/80 bg-slate-50 p-8">
            <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-white shadow-sm ring-1 ring-slate-200">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18"/>
              </svg>
            </div>
            <h3 class="text-base font-semibold text-slate-900">Belum ada data akreditasi</h3>
            <p class="mt-1 text-sm text-slate-600">Silakan tambahkan melalui dasbor untuk menampilkan data akreditasi program studi.</p>
            <div class="mt-4">
              <a href="{{ url('/dashboard') }}"
                 class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-900 via-indigo-800 to-purple-900 px-3.5 py-2 text-sm font-medium text-white shadow-lg hover:opacity-90 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-indigo-700">
                Buka Dasbor
              </a>
            </div>
          </div>
        @else
          {{-- SEARCH kecil tanpa backend (opsional, bisa dihapus kalau tak perlu) --}}
          <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="text-sm text-slate-600">
              Total program studi: <span class="font-semibold text-slate-900">{{ $akreditasis->count() }}</span>
            </div>
            {{-- <div class="relative max-w-xs">
              <input id="filterInput" type="text" placeholder="Cari prodi / nilai…"
                     class="w-full rounded-lg border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200/50">
              <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"/>
                </svg>
              </div>
            </div> --}}
          </div>

          <div class="overflow-x-auto rounded-xl">
            <table class="min-w-full text-sm">
              <thead class="sticky top-0 z-10 bg-slate-50/80 backdrop-blur">
                <tr class="text-left text-slate-600">
                  <th class="px-4 py-3 font-semibold">Program Studi</th>
                  <th class="px-4 py-3 font-semibold">Jenjang</th>
                  <th class="px-4 py-3 font-semibold">Tahun</th>
                  <th class="px-4 py-3 font-semibold">Nilai</th>
                  <th class="px-4 py-3 font-semibold">Keterangan</th>
                </tr>
              </thead>
              <tbody id="akreditasiTable" class="divide-y divide-slate-100">
                @foreach ($akreditasis as $akreditasi)
                  @php
                    $nilai = strtoupper(trim((string) $akreditasi->nilai));
                    // mapping warna badge
                    $badge = match(true) {
                      str_contains($nilai,'UNGGUL')      => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
                      str_contains($nilai,'BAIK SEKALI') => 'bg-sky-50 text-sky-700 ring-sky-200',
                      $nilai === 'A'                      => 'bg-indigo-50 text-indigo-700 ring-indigo-200',
                      $nilai === 'B'                      => 'bg-amber-50 text-amber-700 ring-amber-200',
                      $nilai === 'C'                      => 'bg-rose-50 text-rose-700 ring-rose-200',
                      str_contains($nilai,'BAIK')         => 'bg-teal-50 text-teal-700 ring-teal-200',
                      default                             => 'bg-slate-50 text-slate-700 ring-slate-200',
                    };
                  @endphp
                  <tr class="hover:bg-slate-50 transition">
                    <td class="px-4 py-3 text-slate-900 font-medium">{{ $akreditasi->nama_program_studi }}</td>
                    <td class="px-4 py-3">
                      <span class="inline-flex items-center rounded-full bg-slate-50 px-2.5 py-1 text-xs font-medium text-slate-700 ring-1 ring-inset ring-slate-200">
                        {{ $akreditasi->jenjang }}
                      </span>
                    </td>
                    <td class="px-4 py-3 text-slate-700">{{ $akreditasi->tahun }}</td>
                    <td class="px-4 py-3">
                      <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $badge }}">
                        {{ $akreditasi->nilai }}
                      </span>
                    </td>
                    <td class="px-4 py-3 text-slate-700">{{ $akreditasi->keterangan }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>
  </div>

  {{-- Mini filter client-side (tanpa lib) --}}
  @push('scripts')
    <script>
      const input = document.getElementById('filterInput');
      const tbody = document.getElementById('akreditasiTable');
      if (input && tbody) {
        input.addEventListener('input', () => {
          const q = input.value.toLowerCase();
          for (const row of tbody.rows) {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(q) ? '' : 'none';
          }
        });
      }
    </script>
  @endpush
@endsection
