{{-- resources/views/admin/kontak/show.blade.php --}}
@extends('layouts.admin')
@section('title','Detail Pesan')

@section('content')
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-2">
    <ol class="breadcrumb bg-transparent m-0 small">
      <li class="breadcrumb-item">
        <a class="link-light text-decoration-none" href="{{ route('admin.dashboard') }}">
          Dashboard
        </a>
      </li>
      <li class="breadcrumb-item">
        <a class="link-light text-decoration-none" href="{{ route('admin.kontak.index') }}">
          Inbox Kontak
        </a>
      </li>
      <li class="breadcrumb-item active text-white-50">Detail Pesan</li>
    </ol>
  </nav>

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">Detail Pesan</h1>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <dl class="row mb-0">
        <dt class="col-md-2">Nama</dt>
        <dd class="col-md-10 fw-semibold">{{ $kontak->nama }}</dd>

        <dt class="col-md-2">Email</dt>
        <dd class="col-md-10">{{ $kontak->email }}</dd>

        <dt class="col-md-2">Tanggal</dt>
        <dd class="col-md-10">{{ optional($kontak->created_at)->format('d M Y H:i') }}</dd>

        <dt class="col-md-2">Pesan</dt>
        <dd class="col-md-10" style="white-space:pre-wrap">{{ $kontak->pesan }}</dd>
      </dl>
    </div>

    <div class="card-footer d-flex flex-wrap gap-2">
      <!-- Tombol kembali -->
      <a href="{{ route('admin.kontak.index') }}" class="btn btn-secondary"> Kembali </a>

      <!-- Tandai dibaca -->
      @can('kontak_edit')
        <form action="{{ route('admin.kontak.update', $kontak) }}" method="POST" class="d-inline">
          @csrf @method('PUT')
          <button class="btn btn-warning">
            <i class="bi bi-check2-circle"></i> Tandai Dibaca
          </button>
        </form>
      @endcan

      <!-- Hapus -->
      @can('kontak_delete')
        <form action="{{ route('admin.kontak.destroy', $kontak) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Yakin hapus pesan ini?')">
          @csrf @method('DELETE')
          <button class="btn btn-danger">
            <i class="bi bi-trash"></i> Hapus
          </button>
        </form>
      @endcan
    </div>
  </div>
@endsection
