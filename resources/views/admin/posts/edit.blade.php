@extends('layouts.admin')
@section('title','Edit Post')

@section('content')
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h4 mb-0">Edit Post</h1>
    <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-light">← Back</a>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  <div class="card shadow-sm">
    <div class="card-body">
      {{-- ✅ PERBAIKAN: TAMBAHKAN $post DI route() --}}
      <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
          <label class="form-label fw-semibold">Judul</label>
          <input type="text" name="judul" class="form-control" value="{{ old('judul', $post->judul) }}" required>
          @error('judul') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Isi Artikel</label>
          <textarea name="isi" class="form-control summernote" rows="8" required>{{ old('isi', $post->isi) }}</textarea>
          @error('isi') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Kategori</label>
            <input type="text" name="kategori" class="form-control" value="{{ old('kategori', $post->kategori) }}">
            @error('kategori') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Tanggal</label>
            <input
              type="date"
              name="tanggal"
              class="form-control"
              value="{{ old('tanggal', $post->tanggal ? \Illuminate\Support\Carbon::parse($post->tanggal)->format('Y-m-d') : null) }}"
            >
            @error('tanggal') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
        </div>

        {{-- ========== GAMBAR + LIVE PREVIEW ========== --}}
        <div class="mb-3">
          <label class="form-label fw-semibold d-block">Gambar</label>

          @php
            // Bangun URL sekarang pakai asset('storage/...') supaya port 8000 ikut terbawa
            $currentUrl = null;
            if (!empty($post->gambar)) {
              // handle jika di DB sudah tersimpan "storage/..." (hindari double "storage")
              $path = \Illuminate\Support\Str::startsWith($post->gambar, 'storage/')
                     ? $post->gambar
                     : 'storage/'.$post->gambar;
              $currentUrl = asset($path);
            }
          @endphp

          <div class="mb-2">
            <img id="img-preview"
                 src="{{ $currentUrl }}"
                 alt="Preview gambar"
                 class="img-thumbnail {{ $currentUrl ? '' : 'd-none' }}"
                 style="max-width: 360px; height: auto; object-fit: cover;">
          </div>

          <input type="file" name="gambar" id="gambarInput" class="form-control" accept=".jpg,.jpeg,.png,.webp">
          <small class="text-muted">Kosongkan jika tidak ingin mengganti.</small>
          @error('gambar') <small class="text-danger d-block">{{ $message }}</small> @enderror
        </div>
        {{-- ============================================ --}}

        <div class="mb-3">
          <label class="form-label fw-semibold">Status</label>
          <select name="status" class="form-control">
            {{-- ✅ PERBAIKAN: GANTI value jadi 'published' dan 'draft' --}}
            <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Post</option>
            <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draf</option>
          </select>
          @error('status') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mt-4">
         <button class="btn btn-primary" type="submit">
           <i class="bi bi-save"></i> Update </button>
          <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary ms-2">Kembali</a>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
  {{-- jQuery & Summernote --}}
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      $('.summernote').summernote({ height: 250 });

      // Live preview gambar ketika user memilih file baru
      const input = document.getElementById('gambarInput');
      const img   = document.getElementById('img-preview');

      input.addEventListener('change', function () {
        const file = this.files && this.files[0];
        if (!file) return;
        const url = URL.createObjectURL(file);
        img.src = url;
        img.classList.remove('d-none');
        img.onload = () => URL.revokeObjectURL(url);
      });
    });
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