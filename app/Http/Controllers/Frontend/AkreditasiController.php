<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;  // ✅ ini wajib
use App\Models\Akreditasi;
use Illuminate\Http\Request;

class AkreditasiController extends Controller
{
    // 🔹 FRONTEND: Tampilkan data untuk pengunjung
    public function index()
{
    $akreditasis = \App\Models\Akreditasi::all();
    return view('frontend.tentang.akreditasi', compact('akreditasis'));
}

    // 🔹 ADMIN: Tampilkan daftar data (untuk admin)
    public function adminIndex()
    {
        $akreditasis = Akreditasi::all();
        return view('admin.akreditasi.index', compact('akreditasis'));
    }

    // 🔹 ADMIN: Form tambah data
    public function create()
    {
        return view('admin.akreditasi.create');
    }

    // 🔹 ADMIN: Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'program_studi' => 'required',
            'jenjang' => 'required',
            'nilai_akreditasi' => 'required',
            'lembaga' => 'required',
            'tanggal_sk' => 'required|date',
            'masa_berlaku' => 'required',
        ]);

        Akreditasi::create($request->all());

        return redirect()->route('admin.akreditasi.index')->with('success', 'Data akreditasi berhasil ditambahkan');
    }

    // 🔹 ADMIN: Form edit data
    public function edit(Akreditasi $akreditasi)
    {
        return view('admin.akreditasi.edit', compact('akreditasi'));
    }

    // 🔹 ADMIN: Update data
    public function update(Request $request, Akreditasi $akreditasi)
    {
        $request->validate([
            'program_studi' => 'required',
            'jenjang' => 'required',
            'nilai_akreditasi' => 'required',
            'lembaga' => 'required',
            'tanggal_sk' => 'required|date',
            'masa_berlaku' => 'required',
        ]);

        $akreditasi->update($request->all());

        return redirect()->route('admin.akreditasi.index')->with('success', 'Data akreditasi berhasil diperbarui');
    }

    // 🔹 ADMIN: Hapus data
    public function destroy(Akreditasi $akreditasi)
    {
        $akreditasi->delete();
        return redirect()->route('admin.akreditasi.index')->with('success', 'Data akreditasi berhasil dihapus');
    }
}