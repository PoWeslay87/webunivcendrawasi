<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    /**
     * List Program Studi + pencarian.
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q'));

        $items = ProgramStudi::when($q, function ($query) use ($q) {
                $like = "%{$q}%";
                $query->where(function ($w) use ($like) {
                    $w->where('nama_program_studi', 'like', $like)
                      ->orWhere('jenjang', 'like', $like)
                      ->orWhere('fakultas', 'like', $like)
                      ->orWhere('keterangan', 'like', $like);
                });
            })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.program-studi.index', compact('items', 'q'));
    }

    /**
     * Form create.
     */
    public function create()
    {
        return view('admin.program-studi.create');
    }

    /**
     * Simpan data baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_program_studi' => 'required|string|max:190',
            'jenjang'            => 'required|string|max:50',   // S1, S2, D3, dll.
            'fakultas'           => 'required|string|max:190',
            'keterangan'         => 'nullable|string',
        ]);

        ProgramStudi::create($data);

        return redirect()
            ->route('admin.program-studi.index')
            ->with('success', 'Program Studi berhasil ditambahkan.');
    }

    /**
     * Form edit.
     */
    public function edit(ProgramStudi $programStudi)
    {
        return view('admin.program-studi.edit', compact('programStudi'));
    }

    /**
     * Update data.
     */
    public function update(Request $request, ProgramStudi $programStudi)
    {
        $data = $request->validate([
            'nama_program_studi' => 'required|string|max:190',
            'jenjang'            => 'required|string|max:50',
            'fakultas'           => 'required|string|max:190',
            'keterangan'         => 'nullable|string',
        ]);

        $programStudi->update($data);

        return redirect()
            ->route('admin.program-studi.index')
            ->with('success', 'Program Studi berhasil diperbarui.');
    }

    /**
     * Hapus data.
     */
    public function destroy(ProgramStudi $programStudi)
    {
        $programStudi->delete();

        return redirect()
            ->route('admin.program-studi.index')
            ->with('success', 'Program Studi berhasil dihapus.');
    }
}
