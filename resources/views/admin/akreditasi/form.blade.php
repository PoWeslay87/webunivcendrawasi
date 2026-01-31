@csrf
<div class="mb-3">
  <label class="form-label">Nama Program Studi</label>
  <input type="text" name="nama_program_studi" class="form-control @error('nama_program_studi') is-invalid @enderror"
         value="{{ old('nama_program_studi', $akreditasi->nama_program_studi ?? '') }}" required>
  @error('nama_program_studi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label class="form-label">Jenjang</label>
  @php
    $opsiJenjang = ['D3'=>'D3','S1'=>'S1','S2'=>'S2','S3'=>'S3','Profesi'=>'Profesi','Diploma'=>'Diploma'];
    $valJenjang = old('jenjang', $akreditasi->jenjang ?? '');
  @endphp
  <select name="jenjang" class="form-select @error('jenjang') is-invalid @enderror" required>
    <option value="" disabled {{ $valJenjang==''?'selected':'' }}>-- Pilih Jenjang --</option>
    @foreach($opsiJenjang as $k=>$v)
      <option value="{{ $k }}" {{ $valJenjang==$k?'selected':'' }}>{{ $v }}</option>
    @endforeach
  </select>
  @error('jenjang')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label class="form-label">Tahun</label>
  <input type="number" name="tahun" min="1950" max="{{ date('Y')+5 }}"
         class="form-control @error('tahun') is-invalid @enderror"
         value="{{ old('tahun', $akreditasi->tahun ?? date('Y')) }}" required>
  @error('tahun')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label class="form-label">Nilai</label>
  @php
    $opsiNilai = ['A (Unggul)','B (Baik Sekali)','C (Baik)','Terakreditasi','Tidak Terakreditasi'];
    $valNilai = old('nilai', $akreditasi->nilai ?? '');
  @endphp
  <select name="nilai" class="form-select @error('nilai') is-invalid @enderror" required>
    <option value="" disabled {{ $valNilai==''?'selected':'' }}>-- Pilih Nilai --</option>
    @foreach($opsiNilai as $n)
      <option value="{{ $n }}" {{ $valNilai==$n?'selected':'' }}>{{ $n }}</option>
    @endforeach
  </select>
  @error('nilai')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label class="form-label">Keterangan (opsional)</label>
  <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
         value="{{ old('keterangan', $akreditasi->keterangan ?? '') }}">
  @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
