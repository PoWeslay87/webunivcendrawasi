<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Akreditasi;
use Illuminate\Http\Request;

class AkreditasiController extends Controller
{
    /**
     * List + pencarian
     */
    public function index(Request $request)
    {
        $q = $request->get('q');

        $items = Akreditasi::when($q, function ($s) use ($q) {
                $s->where('nama_program_studi', 'like', "%$q%")
                  ->orWhere('jenjang', 'like', "%$q%")
                  ->orWhere('tahun', 'like', "%$q%")
                  ->orWhere('nilai', 'like', "%$q%");
            })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.akreditasi.index', compact('items', 'q'));
    }

    /**
     * Form create
     */
    public function create()
    {
        return view('admin.akreditasi.create');
    }

    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        $maxYear = (int) date('Y') + 5;

        $data = $request->validate([
            'nama_program_studi' => 'required|string|max:190',
            'jenjang'            => 'required|string|max:50',
            'tahun'              => "required|integer|digits:4|min:1950|max:$maxYear",
            'nilai'              => 'required|string|max:50',
            'keterangan'         => 'nullable|string|max:255',
        ]);

        Akreditasi::create($data);

        return redirect()->route('admin.akreditasi.index')
            ->with('success', 'Data akreditasi berhasil ditambahkan.');
    }

    /**
     * Form edit
     */
    public function edit(Akreditasi $akreditasi)
    {
        return view('admin.akreditasi.edit', compact('akreditasi'));
    }

    /**
     * Update data
     */
    public function update(Request $request, Akreditasi $akreditasi)
    {
        $maxYear = (int) date('Y') + 5;

        $data = $request->validate([
            'nama_program_studi' => 'required|string|max:190',
            'jenjang'            => 'required|string|max:50',
            'tahun'              => "required|integer|digits:4|min:1950|max:$maxYear",
            'nilai'              => 'required|string|max:50',
            'keterangan'         => 'nullable|string|max:255',
        ]);

        $akreditasi->update($data);

        return redirect()->route('admin.akreditasi.index')
            ->with('success', 'Data akreditasi berhasil diperbarui.');
    }

    /**
     * Hapus data
     */
    public function destroy(Akreditasi $akreditasi)
    {
        $akreditasi->delete();

        return redirect()->route('admin.akreditasi.index')
            ->with('success', 'Data akreditasi berhasil dihapus.');
    }
}
