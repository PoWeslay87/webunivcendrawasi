{{-- resources/views/admin/site-stats/index.blade.php --}}
@extends('layouts.admin')
@section('title','Site Stats')

@section('content')
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-2">
    <ol class="breadcrumb bg-transparent m-0 small">
      <li class="breadcrumb-item">
        <a class="link-light text-decoration-none" href="{{ route('admin.dashboard') }}">
          Dashboard
        </a>
      </li>
      <li class="breadcrumb-item active text-white-50">Site Stats</li>
    </ol>
  </nav>

  <!-- Header + Tambah -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">Site Stats</h1>
    @can('stats_create')
      <a href="{{ route('admin.site-stats.create') }}" class="btn btn-sm btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah
      </a>
    @endcan
  </div>

  <!-- Card Table -->
  <div class="card shadow-sm border-0">
    <div class="card-header bg-transparent fw-semibold">
      Daftar Statistik
    </div>
    <div class="table-responsive">
      <table class="table table-dark table-striped table-hover align-middle mb-0">
        <thead>
          <tr class="text-uppercase small text-secondary text-center">
            <th style="width:60px">No</th>
            <th>Label</th>
            <th>Value</th>
            <th>Suffix</th>
            <th>Sort</th>
            <th>Aktif</th>
            <th style="width:160px">Aksi</th>
          </tr>
        </thead>
        <tbody>
        @forelse($items as $i => $it)
          <tr>
            <td class="text-center">{{ $items->firstItem() + $i }}</td>
            <td>
              <i class="bi bi-graph-up-arrow me-2 text-info"></i>
              {{ $it->label }}
            </td>
            <td class="text-end">{{ number_format($it->value, 0, ',', '.') }}</td>
            <td class="text-center">{{ $it->suffix ?? '—' }}</td>
            <td class="text-center">{{ $it->sort }}</td>
            <td class="text-center">
              <span class="badge text-bg-{{ $it->is_active ? 'success' : 'secondary' }}">
                {{ $it->is_active ? 'Aktif' : 'Nonaktif' }}
              </span>
            </td>
            <td class="text-center">
              @can('stats_edit')
                <a href="{{ route('admin.site-stats.edit',$it) }}" 
                   class="btn btn-sm btn-warning me-1" title="Edit">
                  <i class="bi bi-pencil-square"></i>
                </a>
              @endcan
              @can('stats_delete')
                <form action="{{ route('admin.site-stats.destroy',$it) }}" 
                      method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus item ini?');">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-danger" title="Hapus">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              @endcan
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center text-secondary p-4">
              <i class="bi bi-file-earmark-text me-2"></i>
              Belum ada data statistik.
            </td>
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
