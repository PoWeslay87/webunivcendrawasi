@extends('layouts.admin')
@section('title','Create Permission')

@section('content')
<h1 class="h4 mb-3">Create Permission</h1>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('admin.permissions.store') }}" method="POST" class="card shadow-sm p-3">
  @csrf
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
  </div>
  <div class="d-flex gap-2">
    <button class="btn btn-primary">Create</button>
    <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Kembali</a>
  </div>
</form>
@endsection
