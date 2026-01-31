{{-- resources/views/admin/users/index.blade.php --}}
@extends('layouts.admin')
@section('title','Users')

@section('content')
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-2">
    <ol class="breadcrumb bg-transparent m-0 small">
      <li class="breadcrumb-item">
        <a class="link-light text-decoration-none" href="{{ route('admin.dashboard') }}">
          Dashboard
        </a>
      </li>
      <li class="breadcrumb-item active text-white-50">Users</li>
    </ol>
  </nav>

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">Users</h1>
    @can('user_create')
      <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">
        <i class="bi bi-person-plus me-1"></i> Buat User Baru
      </a>
    @endcan
  </div>

  <!-- Card Table -->
  <div class="card shadow-sm">
    <div class="table-responsive">
      <table class="table table-dark table-striped table-hover align-middle m-0">
        <thead>
          <tr class="text-uppercase small text-secondary">
            <th style="width:70px">No</th>
            <th>Nama</th>
            <th>Email</th>
            <th style="width:150px">Role</th>
            <th style="width:140px" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $u)
            <tr>
              <td class="text-center">{{ $users->firstItem() + $loop->index }}</td>
              <td class="fw-semibold">{{ $u->name }}</td>
              <td class="text-truncate" style="max-width:280px;">{{ $u->email }}</td>
              <td>
                @if($u->roles->isNotEmpty())
                  <span class="badge bg-info text-dark">{{ $u->roles->pluck('name')->implode(', ') }}</span>
                @else
                  <span class="badge bg-secondary">—</span>
                @endif
              </td>
              <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                  @can('user_edit')
                    <a href="{{ route('admin.users.edit',$u) }}" 
                       class="btn btn-sm btn-warning" title="Edit User">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                  @endcan

                  @can('user_delete')
                    <form action="{{ route('admin.users.destroy',$u) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin hapus user ini?')">
                      @csrf @method('DELETE')
                      <button class="btn btn-sm btn-danger" title="Hapus User">
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
                <i class="bi bi-people-fill me-2"></i> Belum ada user terdaftar.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Footer Pagination -->
    <div class="card-footer d-flex flex-wrap align-items-center justify-content-between gap-2">
      <div class="small text-secondary">
        @if($users->total() > 0)
          Menampilkan <span class="text-white">{{ $users->firstItem() }}</span> –
          <span class="text-white">{{ $users->lastItem() }}</span>
          dari <span class="text-white">{{ $users->total() }}</span> user
        @endif
      </div>
      <nav class="ms-auto">
        {{ $users->onEachSide(1)->links('pagination::bootstrap-5') }}
      </nav>
    </div>
  </div>
@endsection
