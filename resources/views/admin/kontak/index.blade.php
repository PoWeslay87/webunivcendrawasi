{{-- resources/views/admin/kontak/index.blade.php --}}
@extends('layouts.admin')
@section('title','Kontak')

@section('content')
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-2">
    <ol class="breadcrumb bg-transparent m-0 small">
      <li class="breadcrumb-item">
        <a class="link-light text-decoration-none" href="{{ route('admin.dashboard') }}">
          Dashboard
        </a>
      </li>
      <li class="breadcrumb-item active text-white-50">Inbox Kontak</li>
    </ol>
  </nav>

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">Inbox Kontak</h1>
  </div>

  <!-- Card Table -->
  <div class="card shadow-sm">
    <div class="table-responsive">
      <table class="table table-dark table-striped table-hover align-middle m-0">
        <thead>
          <tr class="text-uppercase small text-secondary">
            <th style="width:70px">No</th>
            <th>Nama & Email</th>
            <th>Pesan</th>
            <th style="width:180px">Tanggal</th>
            <th style="width:140px" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($kontak as $k)
            <tr>
              <td class="text-center">{{ $kontak->firstItem() + $loop->index }}</td>

              {{-- Nama + Email --}}
              <td>
                <div class="fw-semibold">{{ $k->nama }}</div>
                <small class="text-muted">{{ $k->email }}</small>
              </td>

              {{-- Pesan --}}
              <td>
                <div class="text-truncate" style="max-width:380px;" title="{{ $k->pesan }}">
                  {{ \Illuminate\Support\Str::limit(strip_tags($k->pesan), 80) }}
                </div>
              </td>

              {{-- Tanggal --}}
              <td class="text-nowrap">{{ optional($k->created_at)->format('d M Y H:i') }}</td>

              {{-- Aksi --}}
              <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                  @can('kontak_view')
                    <a href="{{ route('admin.kontak.show', $k) }}" 
                       class="btn btn-sm btn-info" title="Lihat Pesan">
                      <i class="bi bi-eye"></i>
                    </a>
                  @endcan

                  @can('kontak_delete')
                    <form action="{{ route('admin.kontak.destroy',$k) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin hapus pesan ini?')">
                      @csrf @method('DELETE')
                      <button class="btn btn-sm btn-danger" title="Hapus Pesan">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  @endcan
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center text-secondary p-4">
                <i class="bi bi-envelope-paper-heart me-2"></i>
                Belum ada pesan masuk.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Footer Pagination -->
    <div class="card-footer d-flex flex-wrap align-items-center justify-content-between gap-2">
      <div class="small text-secondary">
        @if($kontak->total() > 0)
          Menampilkan <span class="text-white">{{ $kontak->firstItem() }}</span> –
          <span class="text-white">{{ $kontak->lastItem() }}</span>
          dari <span class="text-white">{{ $kontak->total() }}</span> pesan
        @endif
      </div>
      <nav class="ms-auto">
        {{ $kontak->onEachSide(1)->links('pagination::bootstrap-5') }}
      </nav>
    </div>
  </div>
@endsection
