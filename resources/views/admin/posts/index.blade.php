@extends('layouts.admin')
@section('title','Posts')

@push('styles')
<style>
  /* Table dark elegan */
  .table-dark-custom thead {
    background-color: #1f2937; /* abu gelap */
    color: #f9fafb;           /* putih */
  }
  .table-dark-custom tbody tr {
    background-color: #111827; 
    color: #e5e7eb;
  }
  .table-dark-custom tbody tr:hover {
    background-color: #1e293b; 
  }
  .table-dark-custom td, 
  .table-dark-custom th {
    vertical-align: middle;
    white-space: nowrap;
  }
  .table-dark-custom img {
    border-radius: 6px;
  }
</style>
@endpush

@section('content')
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h4 mb-0">Posts</h1>

    @can('posts_create')
      <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Create
      </a>
    @endcan
  </div>

  <div class="card shadow-sm bg-dark text-light border-0">
    <div class="card-header bg-transparent fw-semibold border-0">
      Daftar Artikel
    </div>
    <div class="card-body p-0">
      @if($posts->count())
        <div class="table-responsive">
          <table class="table table-custom align-middle m-0">
            <thead class="text-center">
              <tr>
                <th style="width:60px">No</th>
                <th style="width:100px">Foto</th>
                <th style="min-width:250px">Judul</th>
                <th style="width:180px">Kategori</th>
                <th style="width:160px">Penulis</th>
                <th style="width:140px">Tanggal</th>
                <th style="min-width:350px">Cuplikan Isi</th>
                <th style="width:120px">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($posts as $post)
              <tr>
                <td class="text-center">{{ $posts->firstItem() + $loop->index }}</td>

                <td class="text-center">
                  @if(!empty($post->gambar))
                    <img src="{{ asset('storage/'.$post->gambar) }}" alt="thumb {{ $post->judul }}"
                         style="width:70px; height:50px; object-fit:cover;">
                  @else
                    <span class="badge bg-secondary">No Img</span>
                  @endif
                </td>

                <td class="fw-semibold text-truncate" style="max-width:250px" title="{{ $post->judul }}">
                  {{ $post->judul }}
                </td>

                <td class="text-center text-truncate" title="{{ $post->kategori }}">
                  {{ $post->kategori ?? '-' }}
                </td>

                <td class="text-center fw-semibold text-truncate" title="{{ optional($post->user)->name }}">
                  {{ optional($post->user)->name ?? '-' }}
                </td>

                <td class="text-center">
                  @if(!empty($post->tanggal))
                    {{ \Illuminate\Support\Carbon::parse($post->tanggal)->format('d M Y') }}
                  @else
                    -
                  @endif
                </td>

                <td class="text-truncate" style="max-width:350px;" title="{{ strip_tags($post->isi) }}">
                  {{ \Illuminate\Support\Str::limit(strip_tags($post->isi), 160) }}
                </td>

                <td class="text-center">
                  <div class="d-flex justify-content-center gap-2">
                    @can('posts_edit')
                      <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning btn-sm px-2" title="Edit">
                        <i class="bi bi-pencil-square"></i>
                      </a>
                    @endcan

                    @can('posts_delete')
                      <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin hapus artikel ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm px-2" title="Delete">
                          <i class="bi bi-trash"></i>
                        </button>
                      </form>
                    @endcan
                  </div>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>

        <div class="d-flex justify-content-between align-items-center p-3 small text-muted">
          <div>
            Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} results
          </div>
          {{ $posts->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>

      @else
        <div class="p-4">
          <div class="alert alert-info mb-0">Belum ada artikel.</div>
        </div>
      @endif
    </div>
  </div>
@endsection
