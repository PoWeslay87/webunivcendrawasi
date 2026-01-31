<x-app-layout>
<div class="container">
    <h2>Edit Kontak</h2>
    <form action="{{ route('kontak.update', $kontak->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" value="{{ $kontak->alamat }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $kontak->email }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="telepon" value="{{ $kontak->telepon }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Maps (iframe)</label>
            <textarea name="maps" class="form-control">{{ $kontak->maps }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
</x-app-layout>
