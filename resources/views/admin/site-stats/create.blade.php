@extends('layouts.admin')
@section('title','Tambah Site Stat')

@section('content')
  <h1 class="h4 mb-3">Tambah Site Stat</h1>

  <div class="card p-3 shadow-sm">
    <form method="POST" action="{{ route('admin.site-stats.store') }}">
      @csrf
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Label</label>
          <input name="label" class="form-control" value="{{ old('label') }}" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Value</label>
          <input type="number" name="value" class="form-control" min="0" value="{{ old('value',0) }}" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Suffix</label>
          <input name="suffix" class="form-control" value="{{ old('suffix') }}" placeholder="+ / Tahun">
        </div>

        <div class="col-12">
          <label class="form-label">Deskripsi</label>
          <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="col-md-3">
          <label class="form-label">Sort</label>
          <input type="number" name="sort" class="form-control" min="1" value="{{ old('sort',1) }}" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Aktif</label>
          <select name="is_active" class="form-select">
            <option value="1" {{ old('is_active',1)==1?'selected':'' }}>Aktif</option>
            <option value="0" {{ old('is_active',1)==0?'selected':'' }}>Nonaktif</option>
          </select>
        </div>
      </div>

      <div class="mt-3 d-flex gap-2">
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.site-stats.index') }}" class="btn btn-secondary">Kembali</a>
      </div>
    </form>
  </div>
@endsection
