@extends('layouts.admin')
@section('title','Create User')

@section('content')
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h4 mb-0">Create User</h1>
  </div>

  @if (session('generated_password'))
    <div class="alert alert-warning">
      <strong>Password otomatis:</strong> {{ session('generated_password') }} <br>
      (Simpan sekarang, tidak akan ditampilkan lagi.)
    </div>
  @endif

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
      <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Password <small class="text-secondary">(kosongkan untuk auto)</small></label>
            <input type="password" name="password" class="form-control" minlength="8">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" minlength="8">
          </div>
        </div>

        <div class="mb-4">
          <label class="form-label d-block mb-2">Roles</label>
          <div class="d-flex flex-wrap gap-3">
            @foreach($roles as $role)
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="role-{{ $role->id }}"
                       name="roles[]" value="{{ $role->name }}">
                <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
              </div>
            @endforeach
          </div>
        </div>

        @can('users_create')
          <button type="submit" class="btn btn-primary">Create</button>
        @endcan
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary ms-2">Kembali</a>
      </form>
    </div>
  </div>
@endsection
