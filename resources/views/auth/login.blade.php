{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.frontend')
@vite(['resources/css/app.css','resources/js/app.js'])
@section('title','Login')  
<br>
<br> 
@section('content')
<div class="min-h-screen bg-gradient-to-b from-slate-900 via-slate-900 to-slate-800 flex items-center justify-center py-10 px-4">
  <div class="w-full max-w-md">
    {{-- Header kecil --}}
    <div class="text-center mb-6">
      <h1 class="text-2xl font-semibold text-white">Masuk ke Akun</h1>
      <p class="text-slate-300 text-sm mt-1">Silakan isi email & password Anda</p>
    </div>

    {{-- Kartu form --}}
    <div class="rounded-2xl bg-white/5 backdrop-blur-sm ring-1 ring-white/10 shadow-xl">
      <div class="p-6 sm:p-8">

        {{-- Session status / global message --}}
        @if (session('status'))
          <div class="mb-4 rounded-lg bg-emerald-500/10 text-emerald-300 ring-1 ring-emerald-400/30 px-3 py-2 text-sm">
            {{ session('status') }}
          </div>
        @endif

        {{-- Error global --}}
        @if ($errors->any())
          <div class="mb-4 rounded-lg bg-rose-500/10 text-rose-300 ring-1 ring-rose-400/30 px-3 py-2 text-sm">
            Ada data yang belum valid. Silakan cek kembali.
          </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
          @csrf

          {{-- Email --}}
          <div>
            <label for="email" class="block text-sm font-medium text-slate-200 mb-1">Email</label>
            <div class="relative">
              <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                class="block w-full rounded-xl bg-slate-800/60 text-slate-100 placeholder-slate-400 ring-1 ring-white/10 focus:ring-2 focus:ring-indigo-400 focus:outline-none px-4 py-3"
                placeholder="Masukkan email Anda">
            </div>
            @error('email')
              <p class="mt-1 text-sm text-rose-300">{{ $message }}</p>
            @enderror
          </div>

          {{-- Password + toggle --}}
          <div>
            <label for="password" class="block text-sm font-medium text-slate-200 mb-1">Password</label>
            <div class="relative">
              <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                class="block w-full rounded-xl bg-slate-800/60 text-slate-100 placeholder-slate-400 ring-1 ring-white/10 focus:ring-2 focus:ring-indigo-400 focus:outline-none px-4 py-3 pr-12"
                placeholder="Masukkan password Anda">
              <button type="button" onclick="togglePwd()" class="absolute inset-y-0 right-0 px-3 text-slate-400 hover:text-slate-200 focus:outline-none" aria-label="Tampilkan / sembunyikan password">
                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.036 12.322C3.423 7.943 7.36 5 12 5c4.64 0 8.577 2.943 9.964 7.322a.859.859 0 010 .356C20.577 16.057 16.64 19 12 19c-4.64 0-8.577-2.943-9.964-7.322a.858.858 0 010-.356z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </button>
            </div>
            @error('password')
              <p class="mt-1 text-sm text-rose-300">{{ $message }}</p>
            @enderror
          </div>

          {{-- Remember & Forgot --}}
          <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-slate-300 text-sm select-none">
              <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-600 bg-slate-800 text-indigo-500 focus:ring-indigo-400">
              Remember me
            </label>

            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="text-sm text-indigo-300 hover:text-indigo-200">
                Lupa password?
              </a>
            @endif
          </div>

          {{-- Submit --}}
          <button type="submit"
                  class="w-full inline-flex justify-center items-center gap-2 rounded-xl bg-indigo-500 hover:bg-indigo-600 text-white font-medium px-4 py-3 transition">
            Login
          </button>

          {{-- Divider --}}
          {{--<div class="flex items-center gap-4">
            <div class="h-px flex-1 bg-white/10"></div>
            <span class="text-slate-400 text-xs">atau</span>
            <div class="h-px flex-1 bg-white/10"></div>
          </div>

          {{-- Register link --}}
          {{--@if (Route::has('register'))
            <a href="{{ route('register') }}"
               class="w-full inline-flex justify-center items-center rounded-xl border border-white/10 text-slate-200 hover:bg-white/5 px-4 py-3 transition">
              Daftar Akun Baru
            </a>
          @endif
        </form>
      </div>
    </div>--}}

    <p class="text-center text-slate-500 text-xs mt-6">
      © {{ date('Y') }} — Universitas Papua City
    </p>
  </div>
</div>

<script>
  function togglePwd() {
    const input = document.getElementById('password');
    const icon  = document.getElementById('eyeIcon');
    const isPwd = input.type === 'password';
    input.type  = isPwd ? 'text' : 'password';
    // Optional: ganti ikon (cukup flip path sederhana / biarkan sama)
  }
</script>
@endsection
