@extends('layouts.admin')
@section('title','Profile')

@section('content')
  <nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb bg-transparent m-0 small">
      <li class="breadcrumb-item">
        <a class="link-light text-decoration-none" href="{{ route('admin.dashboard') }}">Dashboard</a>
      </li>
      <li class="breadcrumb-item active text-white-50">Profile</li>
    </ol>
  </nav>

  @includeWhen(session('status') || $errors->any(), 'layouts.flash')

  <div class="row g-3">
    {{-- Info Akun --}}
    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-header">Informasi Profil</div>
        <div class="card-body">
          <form method="POST" action="{{ route('profile.update') }}" class="vstack gap-3">
            @csrf
            @method('PATCH')

            <div>
              <label class="form-label">Nama</label>
              <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                     class="form-control @error('name') is-invalid @enderror" required>
              @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div>
              <label class="form-label">Email</label>
              <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                     class="form-control @error('email') is-invalid @enderror" required>
              @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="d-flex justify-content-end">
              <button class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- Ubah Password --}}
    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-header">Ubah Password</div>
        <div class="card-body">
          <form method="POST" action="{{ route('password.update') }}" class="vstack gap-3">
            @csrf
            @method('PUT')

            <div>
              <label class="form-label">Password Saat Ini</label>
              <input type="password" name="current_password"
                     class="form-control @error('current_password') is-invalid @enderror" required>
              @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div>
              <label class="form-label">Password Baru</label>
              <input type="password" name="password"
                     class="form-control @error('password') is-invalid @enderror" required>
              @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div>
              <label class="form-label">Konfirmasi Password Baru</label>
              <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <div class="d-flex justify-content-end">
              <button class="btn btn-warning">Update Password</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- Hapus Akun --}}
    <div class="col-12">
      <div class="card border-danger shadow-sm">
        <div class="card-header text-danger">Hapus Akun</div>
        <div class="card-body">
          <p class="mb-3 text-secondary">Aksi ini tidak dapat dibatalkan. Masukkan password untuk konfirmasi.</p>
          <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Yakin menghapus akun?');" class="d-flex gap-2">
            @csrf
            @method('DELETE')
            <input type="password" name="password" class="form-control" placeholder="Password">
            <button class="btn btn-danger">Hapus Akun</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
