@extends('layouts.admin')
@section('title','Program Studi')

@section('content')
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-2">
    <ol class="breadcrumb bg-transparent m-0 small">
      <li class="breadcrumb-item">
        <a class="link-light text-decoration-none" href="{{ route('admin.dashboard') }}">
          Dashboard
        </a>
      </li>
      <li class="breadcrumb-item active text-white-50">Program Studi</li>
    </ol>
  </nav>

  <!-- Header + Tambah -->
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h4 mb-0">Program Studi</h1>
    @can('prodi_create')
      <a href="{{ route('admin.program-studi.create') }}" class="btn btn-sm btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah
      </a>
    @endcan
  </div>

  <!-- Card Table -->
  <div class="card shadow-sm">
    <div class="card-header bg-transparent fw-semibold">
      Daftar Program Studi
    </div>
    <div class="table-responsive">
      <table class="table table-dark table-striped table-hover align-middle m-0">
        <thead>
          <tr class="text-uppercase small text-secondary text-center">
            <th style="width:70px">No</th>
            <th>Nama Program Studi</th>
            <th style="width:120px">Jenjang</th>
            <th>Fakultas</th>
            <th>Keterangan</th>
            <th style="width:160px">Aksi</th>
          </tr>
        </thead>
        <tbody>
        @forelse($items as $it)
          @php($ket = $it->keterangan ?? $it->deskripsi)
          <tr>
            <td class="text-center">
              {{ method_exists($items,'firstItem') ? $items->firstItem() + $loop->index : $loop->iteration }}
            </td>
            <td class="fw-semibold">{{ $it->nama_program_studi }}</td>
            <td class="text-center">{{ $it->jenjang }}</td>
            <td class="text-truncate" style="max-width:220px;" title="{{ $it->fakultas }}">
              {{ \Illuminate\Support\Str::limit($it->fakultas, 40) }}
            </td>
            <td class="text-truncate" style="max-width:260px;" title="{{ $ket }}">
              {{ \Illuminate\Support\Str::limit($ket, 60) }}
            </td>
            <td class="text-center">
              <div class="d-flex justify-content-center gap-2">
                @can('prodi_edit')
                  <a href="{{ route('admin.program-studi.edit',$it) }}" 
                     class="btn btn-sm btn-warning px-2">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                @endcan
                @can('prodi_delete')
                  <form action="{{ route('admin.program-studi.destroy',$it) }}" 
                        method="POST" class="d-inline"
                        onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger px-2">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                @endcan
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center text-secondary p-4">Belum ada data.</td>
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
