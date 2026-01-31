@extends('layouts.admin')
@section('title','Create Role')

@section('content')
<h1 class="h4 mb-3">Create Role</h1>

@if ($errors->any())
  <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
@endif

<form action="{{ route('admin.roles.store') }}" method="POST" class="card shadow-sm p-3">
  @csrf
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label d-block">Permissions</label>
    <div class="d-flex flex-wrap gap-3">
      @foreach($permissions as $perm)
        <label class="form-check me-3">
          <input type="checkbox" name="permissions[]" value="{{ $perm->name }}" class="form-check-input">
          <span class="form-check-label">{{ $perm->name }}</span>
        </label>
      @endforeach
    </div>
  </div>

  <div class="d-flex gap-2">
     <button type="submit" class="btn btn-primary">Create</button>
    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Kembali</a>
  </div>
</form>
@endsection
