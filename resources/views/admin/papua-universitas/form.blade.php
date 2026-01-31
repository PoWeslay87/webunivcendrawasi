@csrf
<div class="mb-3">
  <label class="form-label">Sejarah</label>
  <textarea name="sejarah" rows="5" class="form-control @error('sejarah') is-invalid @enderror">{{ old('sejarah', $papuaUniversitas->sejarah ?? '') }}</textarea>
  @error('sejarah')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label class="form-label">Visi</label>
  <textarea name="visi" rows="4" class="form-control @error('visi') is-invalid @enderror">{{ old('visi', $papuaUniversitas->visi ?? '') }}</textarea>
  @error('visi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label class="form-label">Misi</label>
  <textarea name="misi" rows="6" class="form-control @error('misi') is-invalid @enderror">{{ old('misi', $papuaUniversitas->misi ?? '') }}</textarea>
  @error('misi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
