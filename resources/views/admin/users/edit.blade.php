@extends('layouts.admin')
@section('title','Edit User')

@section('content')
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h4 mb-0">Edit User</h1>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="card shadow-sm">
    <div class="card-body">
      <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')

        {{-- Basic Info --}}
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $user->name) }}" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email', $user->email) }}" required>
          </div>
        </div>

        {{-- Change Password (Optional) --}}
        <div class="mt-4">
          <div class="d-flex align-items-center justify-content-between">
            <h6 class="mb-0 text-uppercase text-secondary">Change Password (optional)</h6>
            <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
          </div>

          <div class="row g-3 mt-1">
            <div class="col-md-6">
              <label class="form-label">New Password</label>
              <div class="input-group">
                <input type="password" name="password" id="password"
                       class="form-control" placeholder="Min. 8 karakter">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label">Confirm New Password</label>
              <div class="input-group">
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="form-control" placeholder="Ulangi password baru">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword2">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        {{-- Roles --}}
        <div class="mt-4">
          <label class="form-label d-block mb-2">Roles</label>
          <div class="d-flex flex-wrap gap-3">
            @foreach($roles as $role)
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="role-{{ $role->id }}"
                       name="roles[]" value="{{ $role->name }}"
                       {{ in_array($role->name, $userRole) ? 'checked' : '' }}>
                <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
              </div>
            @endforeach
          </div>
        </div>

        <div class="mt-4">
          @can('users_edit')
           <button class="btn btn-primary" type="submit">
           <i class="bi bi-save"></i> Update
           </button>
          @endcan
          <a href="{{ route('admin.users.index') }}" class="btn btn-secondary ms-2">Kembali</a>
        </div>
      </form>
    </div>
  </div>

  {{-- Toggle show/hide password --}}
  @push('scripts')
  <script>
    const toggle = (inputId, btnId) => {
      const inp = document.getElementById(inputId);
      const btn = document.getElementById(btnId);
      if (!inp || !btn) return;
      btn.addEventListener('click', () => {
        const isPwd = inp.getAttribute('type') === 'password';
        inp.setAttribute('type', isPwd ? 'text' : 'password');
        const icon = btn.querySelector('i');
        if (icon) icon.className = isPwd ? 'bi bi-eye-slash' : 'bi bi-eye';
      });
    };
    toggle('password','togglePassword');
    toggle('password_confirmation','togglePassword2');
  </script>
  @endpush
@endsection
