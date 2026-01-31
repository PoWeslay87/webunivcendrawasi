{{-- resources/views/admin/akreditasi/index.blade.php --}}
@extends('layouts.admin')

@section('title','Akreditasi')

@section('content')
  {{-- Breadcrumb --}}
  <nav aria-label="breadcrumb" class="mb-2">
    <ol class="breadcrumb bg-transparent m-0 small">
      <li class="breadcrumb-item">
        <a class="link-light text-decoration-none" href="{{ route('admin.dashboard') }}">Dashboard</a>
      </li>
      <li class="breadcrumb-item active text-white-50">Akreditasi</li>
    </ol>
  </nav>

  {{-- Header + Tambah --}}
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h4 mb-0">Akreditasi</h1>
    @can('akre_create')
      <a href="{{ route('admin.akreditasi.create') }}" class="btn btn-sm btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Akreditasi
      </a>
    @endcan
  </div>

  {{-- Card Tabel --}}
  <div class="card shadow-sm border-0">
    <div class="card-header bg-transparent fw-semibold">Daftar Akreditasi</div>

    <div class="table-responsive">
      <table class="table table-dark table-striped table-hover align-middle mb-0">
        <thead>
          <tr class="text-uppercase small text-secondary text-center">
            <th style="width:60px">No</th>
            <th style="max-width:220px">Program Studi</th>
            <th style="width:100px">Jenjang</th>
            <th style="width:90px">Tahun</th>
            <th style="width:120px">Nilai</th>
            <th style="max-width:260px">Keterangan</th>
            <th style="width:160px">Aksi</th>
          </tr>
        </thead>
        <tbody>
  @forelse($items as $it)
    <tr>
      <td class="text-center">
        {{ method_exists($items,'firstItem') ? $items->firstItem() + $loop->index : $loop->iteration }}
      </td>
      <td>
        <div class="text-truncate" style="max-width:220px;" title="{{ $it->nama_program_studi }}">
          {{ $it->nama_program_studi }}
        </div>
      </td>
      <td class="text-center">{{ $it->jenjang }}</td>
      <td class="text-center">{{ $it->tahun }}</td>
      <td class="text-center">
        @php
          $nilai = strtoupper($it->nilai);
          $badgeClass = str_contains($nilai,'A') ? 'bg-success' 
                      : (str_contains($nilai,'B') ? 'bg-info' 
                      : (str_contains($nilai,'C') ? 'bg-warning text-dark' 
                      : 'bg-secondary'));
        @endphp
        <span class="badge {{ $badgeClass }}">{{ $it->nilai }}</span>
      </td>
      <td>
        <div class="text-truncate" style="max-width:260px;" title="{{ $it->keterangan }}">
          {{ \Illuminate\Support\Str::limit($it->keterangan, 80) }}
        </div>
      </td>
      <td class="text-center">
        <div class="d-flex justify-content-center gap-2">
          @can('akre_edit')
            <a href="{{ route('admin.akreditasi.edit',$it) }}" class="btn btn-sm btn-warning" title="Edit">
              <i class="bi bi-pencil-square"></i>
            </a>
          @endcan
          @can('akre_delete')
            <form action="{{ route('admin.akreditasi.destroy',$it) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Yakin ingin menghapus data ini?');">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger" title="Hapus">
                <i class="bi bi-trash"></i>
              </button>
            </form>
          @endcan
        </div>
      </td>
    </tr>
  @empty
    <tr>
      <td colspan="7" class="text-center py-5 text-secondary">
        <i class="bi bi-file-earmark-text me-2"></i>
        Belum ada data akreditasi.
      </td>
    </tr>
  @endforelse   {{-- ini penting! HARUS endforelse, bukan endforeach --}}
</tbody>

      </table>
    </div>

    {{-- Footer Pagination --}}
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
