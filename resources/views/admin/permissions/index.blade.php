{{-- resources/views/admin/permissions/index.blade.php --}}
@extends('layouts.admin')
@section('title','Permissions')

@section('content')
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-2">
    <ol class="breadcrumb bg-transparent m-0 small">
      <li class="breadcrumb-item">
        <a class="link-light text-decoration-none" href="{{ route('admin.dashboard') }}">
          Dashboard
        </a>
      </li>
      <li class="breadcrumb-item active text-white-50">Permissions</li>
    </ol>
  </nav>

  <!-- Header + Tambah -->
  <div class="d-flex align-items-center justify-content-between mb-3">
    <div>
      <h1 class="h4 mb-0">Permissions</h1>
      <small class="text-secondary">Kelola hak akses aplikasi</small>
    </div>
    @can('permissions_create')
      <a href="{{ route('admin.permissions.create') }}" class="btn btn-sm btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah
      </a>
    @endcan
  </div>

  <!-- Card Table -->
  <div class="card shadow-sm">
    <div class="table-responsive">
      <table class="table table-dark table-striped table-hover align-middle mb-0">
        <thead>
          <tr class="text-uppercase small text-secondary">
            <th style="width:70px">No</th>
            <th>Name</th>
            <th style="width:100px" class="text-center">Guard</th>
            <th style="width:120px" class="text-center">Roles</th>
            <th style="width:120px" class="text-center">Users</th>
            <th style="width:150px">Created</th>
            <th style="width:160px" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($permissions as $perm)
            <tr>
              {{-- No --}}
              <td class="text-center">
                {{ method_exists($permissions,'firstItem') ? $permissions->firstItem() + $loop->index : $loop->iteration }}
              </td>

              {{-- Name --}}
              <td class="fw-semibold">{{ $perm->name }}</td>

              {{-- Guard --}}
              <td class="text-center">
                <span class="badge text-bg-secondary">{{ $perm->guard_name }}</span>
              </td>

              {{-- Roles --}}
              <td class="text-center">
                <span class="badge rounded-pill text-bg-info">{{ $perm->roles_count ?? 0 }}</span>
              </td>

              {{-- Users --}}
              <td class="text-center">
                <span class="badge rounded-pill text-bg-secondary">{{ $perm->users_count ?? 0 }}</span>
              </td>

              {{-- Created --}}
              <td>{{ optional($perm->created_at)->format('d M Y') }}</td>

              {{-- Aksi --}}
              <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                  @can('permissions_edit')
                    <a href="{{ route('admin.permissions.edit', $perm) }}" 
                       class="btn btn-sm btn-warning" title="Edit">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                  @endcan
                  @can('permissions_delete')
                    <form action="{{ route('admin.permissions.destroy', $perm) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin hapus permission ini?')">
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
              <td colspan="7" class="text-center text-secondary p-4">
                <i class="bi bi-shield-lock me-2"></i>
                Belum ada data permissions.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Footer Pagination -->
    @if(method_exists($permissions,'links'))
      <div class="card-footer d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div class="small text-secondary">
          @if($permissions->total() > 0)
            Menampilkan <span class="text-white">{{ $permissions->firstItem() }}</span> – 
            <span class="text-white">{{ $permissions->lastItem() }}</span>
            dari <span class="text-white">{{ $permissions->total() }}</span> data
          @endif
        </div>
        <nav class="ms-auto">
          {{ $permissions->onEachSide(1)->links('pagination::bootstrap-5') }}
        </nav>
      </div>
    @endif
  </div>
@endsection
