@extends('layouts.admin')
@section('title','Papua Universitas')

@section('content')
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-2">
    <ol class="breadcrumb bg-transparent m-0 small">
      <li class="breadcrumb-item">
        <a class="link-light text-decoration-none" href="{{ route('admin.dashboard') }}">
          Dashboard
        </a>
      </li>
      <li class="breadcrumb-item active text-white-50">Universitas Cenderawasih</li>
    </ol>
  </nav>

  <!-- Header + Tambah -->
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h4 mb-0">Universitas Cenderawasih</h1>
    @canany(['univ_create','create papua-universitas'])
      <a href="{{ route('admin.papua-universitas.create') }}" class="btn btn-sm btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah
      </a>
    @endcanany
  </div>

  <!-- Card Table -->
  <div class="card shadow-sm">
    <div class="card-header bg-transparent fw-semibold">
      Daftar Sejarah, Visi & Misi
    </div>
    <div class="table-responsive">
      <table class="table table-dark table-striped table-hover table-bordered align-middle m-0">
        <thead>
          <tr class="text-uppercase small text-secondary text-center">
            <th style="width:60px">No</th>
            <th style="width:250px">Sejarah</th>
            <th style="width:250px">Visi</th>
            <th style="width:250px">Misi</th>
            <th style="width:140px">Aksi</th>
          </tr>
        </thead>
        <tbody>
        @forelse($items as $it)
          <tr>
            <td class="text-center">
              {{ method_exists($items,'firstItem') ? $items->firstItem() + $loop->index : $loop->iteration }}
            </td>

            <td class="text-truncate" style="max-width:250px" title="{{ strip_tags($it->sejarah) }}">
              {{ \Illuminate\Support\Str::limit(strip_tags($it->sejarah), 80) }}
            </td>

            <td class="text-truncate" style="max-width:250px" title="{{ strip_tags($it->visi) }}">
              {{ \Illuminate\Support\Str::limit(strip_tags($it->visi), 80) }}
            </td>

            <td class="text-truncate" style="max-width:250px" title="{{ strip_tags($it->misi) }}">
              {{ \Illuminate\Support\Str::limit(strip_tags($it->misi), 80) }}
            </td>

            <td class="text-center">
              <div class="d-flex justify-content-center gap-2">
                @canany(['univ_edit','edit papua-universitas'])
                  <a href="{{ route('admin.papua-universitas.edit',$it->id) }}" 
                     class="btn btn-warning btn-sm px-2">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                @endcanany

                @canany(['univ_delete','delete papua-universitas'])
                  <form action="{{ route('admin.papua-universitas.destroy',$it->id) }}" 
                        method="POST" class="d-inline"
                        onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm px-2">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                @endcanany
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center text-secondary p-4">Belum ada data.</td>
          </tr>
        @endforelse
        </tbody>
      </table>
    </div>

    <!-- Footer Pagination -->
    <div class="card-footer d-flex flex-wrap align-items-center justify-content-between gap-2">
      <div class="small text-secondary">
        @if($items instanceof \Illuminate\Contracts\Pagination\Paginator && $items->total() > 0)
          Menampilkan <span class="text-white">{{ $items->firstItem() }}</span> –
          <span class="text-white">{{ $items->lastItem() }}</span>
          dari <span class="text-white">{{ $items->total() }}</span> data
        @endif
      </div>
      <nav class="ms-auto">
        {{ $items instanceof \Illuminate\Contracts\Pagination\Paginator
            ? $items->onEachSide(1)->links('pagination::bootstrap-5')
            : '' }}
      </nav>
    </div>
  </div>
@endsection
