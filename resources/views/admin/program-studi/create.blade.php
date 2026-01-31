@extends('layouts.admin')
@section('title','Tambah Program Studi')

@section('content')
<nav aria-label="breadcrumb" class="mb-3">
  <ol class="breadcrumb bg-transparent m-0">
    <li class="breadcrumb-item"><a class="link-light text-decoration-none" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a class="link-light text-decoration-none" href="{{ route('admin.program-studi.index') }}">Program Studi</a></li>
    <li class="breadcrumb-item active text-white-50">Tambah</li>
  </ol>
</nav>

<h1 class="h4 mb-3">Tambah Program Studi</h1>

<div class="card shadow-sm">
  <div class="card-body">
    <form action="{{ route('admin.program-studi.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label class="form-label">Nama Program Studi</label>
        <input type="text" name="nama_program_studi"
               value="{{ old('nama_program_studi') }}"
               class="form-control @error('nama_program_studi') is-invalid @enderror" required>
        @error('nama_program_studi')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Jenjang</label>
        <select name="jenjang" class="form-select @error('jenjang') is-invalid @enderror" required>
          <option value="">-- Pilih Jenjang --</option>
          @foreach(['D1','D2','D3','D4','S1','S2','S3','Profesi','Spesialis'] as $j)
            <option value="{{ $j }}" {{ old('jenjang') == $j ? 'selected' : '' }}>{{ $j }}</option>
          @endforeach
        </select>
        @error('jenjang')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Fakultas</label>
        <input type="text" name="fakultas"
               value="{{ old('fakultas') }}"
               class="form-control @error('fakultas') is-invalid @enderror" required>
        @error('fakultas')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Keterangan</label>
        <textarea name="keterangan" rows="4"
                  class="form-control @error('keterangan') is-invalid @enderror"
                  placeholder="Masukkan deskripsi atau keterangan">{{ old('keterangan') }}</textarea>
        @error('keterangan')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="d-flex gap-2">
        <button class="btn btn-primary" type="submit">
           Simpan
        </button>
        <a href="{{ route('admin.program-studi.index') }}" class="btn btn-secondary">Kembali</a>
      </div>
    </form>
  </div>
</div>
@endsection
