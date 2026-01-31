{{-- resources/views/admin/roles/index.blade.php --}}
@extends('layouts.admin')
@section('title','Roles')

@section('content')
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-2">
    <ol class="breadcrumb bg-transparent m-0 small">
      <li class="breadcrumb-item">
        <a class="link-light text-decoration-none" href="{{ route('admin.dashboard') }}">
          Dashboard
        </a>
      </li>
      <li class="breadcrumb-item active text-white-50">Roles</li>
    </ol>
  </nav>

  <!-- Header + Tambah -->
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h4 mb-0">Roles</h1>
    @can('roles_create')
      <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-primary">
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
            <th>Nama</th>
            <th style="width:120px" class="text-center">Permissions</th>
            <th style="width:120px" class="text-center">Members</th>
            <th style="width:150px">Dibuat</th>
            <th style="width:180px" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($roles as $role)
            <tr @if($role->name === 'admin') class="table-warning-subtle" @endif>
              {{-- No --}}
              <td class="text-center">
                {{ method_exists($roles,'firstItem') ? $roles->firstItem() + $loop->index : $loop->iteration }}
              </td>

              {{-- Nama --}}
              <td class="fw-semibold">
                {{ ucfirst($role->name) }}
                @if($role->name === 'admin')
                  <span class="badge text-bg-warning text-dark ms-2">Core</span>
                @endif
              </td>

              {{-- Permissions --}}
              <td class="text-center">
                <span class="badge text-bg-info" 
                      title="{{ $role->permissions_count ?? 0 }} permissions">
                  {{ $role->permissions_count ?? 0 }}
                </span>
              </td>

              {{-- Members --}}
              <td class="text-center">
                <span class="badge text-bg-secondary" 
                      title="{{ $role->users_count ?? 0 }} users">
                  {{ $role->users_count ?? 0 }}
                </span>
              </td>

              {{-- Tanggal dibuat --}}
              <td>{{ optional($role->created_at)->format('d M Y') }}</td>

              {{-- Aksi --}}
              <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                  @can('roles_edit')
                    <a href="{{ route('admin.roles.edit', $role) }}" 
                       class="btn btn-sm btn-warning" title="Edit">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                  @endcan

                  @can('roles_delete')
                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin hapus role ini?')">
                      @csrf @method('DELETE')
                      <button class="btn btn-sm btn-danger" 
                              @if($role->name === 'admin') disabled title="Role admin dilindungi" @endif>
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  @endcan
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-secondary p-4">
                <i class="bi bi-file-earmark-text me-2"></i>
                Belum ada data role.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Footer Pagination -->
    @if(method_exists($roles,'links'))
      <div class="card-footer d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div class="small text-secondary">
          @if($roles->total() > 0)
            Menampilkan <span class="text-white">{{ $roles->firstItem() }}</span> – 
            <span class="text-white">{{ $roles->lastItem() }}</span>
            dari <span class="text-white">{{ $roles->total() }}</span> data
          @endif
        </div>
        <nav class="ms-auto">
          {{ $roles->onEachSide(1)->links('pagination::bootstrap-5') }}
        </nav>
      </div>
    @endif
  </div>
@endsection
