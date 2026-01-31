@extends('layouts.admin')
@section('title','Edit Akreditasi')

@section('content')
<nav aria-label="breadcrumb" class="mb-3">
  <ol class="breadcrumb bg-transparent m-0">
    <li class="breadcrumb-item"><a class="link-light text-decoration-none" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a class="link-light text-decoration-none" href="{{ route('admin.akreditasi.index') }}">Akreditasi</a></li>
    <li class="breadcrumb-item active text-white-50">Edit</li>
  </ol>
</nav>

<h1 class="h4 mb-3">Edit Akreditasi</h1>

<div class="card shadow-sm">
  <div class="card-body">
    <form action="{{ route('admin.akreditasi.update', $akreditasi) }}" method="POST">
      @csrf
      @method('PUT')
      @include('admin.akreditasi.form')
      <div class="d-flex gap-2 mt-3">
        <button class="btn btn-primary" type="submit">
          <i class="bi bi-save"></i> Update
        </button>
        <a href="{{ route('admin.akreditasi.index') }}" class="btn btn-secondary">Kembali</a>
      </div>
    </form>
  </div>
</div>
@endsection
