@extends('layouts.admin')
@section('title','Create Post')

@section('content')
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h4 mb-0">Create Post</h1>
    <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-light">← Back</a>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  <div class="card shadow-sm">
    <div class="card-body">
      <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label class="form-label fw-semibold">Judul</label>
          <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Isi Artikel</label>
          <textarea name="isi" class="form-control summernote" rows="8" required>{{ old('isi') }}</textarea>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Kategori</label>
            <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Tanggal</label>
            <input type="date" name="tanggal" id="tanggalInput" class="form-control" value="{{ old('tanggal') }}">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Upload Gambar</label>
          <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png" onchange="previewGambar(event)">
          <small class="text-muted">*format .jpg/.jpeg/.png, maks 2MB</small>
          <div class="mt-3">
            <img id="gambarPreview" src="#" class="img-thumbnail d-none" style="max-height:200px;">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Status</label>
          <select name="status" class="form-control" required>
            <option value="">-- Pilih Status --</option>
            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Post</option>
            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draf</option>
          </select>
        </div>

        <div class="mt-4 d-flex justify-content-between">
          <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Kembali</a>
          <button class="btn btn-primary">Simpan Artikel</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      $('.summernote').summernote({ height: 250 });
      const input = document.getElementById("tanggalInput");
      if (!input.value) input.value = new Date().toISOString().split('T')[0];
    });
    function previewGambar(e){
      const img = document.getElementById('gambarPreview');
      img.src = URL.createObjectURL(e.target.files[0]);
      img.classList.remove('d-none');
    }
  </script>
@endpush

@push('styles')
<style>
  /* Teks di area ketik Summernote jadi putih (hanya di admin) */
  .note-editor.note-frame .note-editable{
    color:#fff !important;              /* teks putih */
    background-color:#111827 !important;/* biar tetap gelap, opsional */
    min-height:220px;
  }
  /* Placeholder Summernote (ketika kosong) */
  .note-editor .note-placeholder{
    color:rgba(255,255,255,.55) !important;
  }
  /* Link di editor biar kebaca */
  .note-editor .note-editable a{
    color:#93c5fd !important;           /* biru muda */
  }
  /* Kode/pre block di dalam editor */
  .note-editor .note-editable pre{
    background:#0b1220; color:#e5e7eb;
  }
</style>
@endpush