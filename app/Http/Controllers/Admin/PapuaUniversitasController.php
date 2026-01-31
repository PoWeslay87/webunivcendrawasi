<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PapuaUniversitas;
use Illuminate\Http\Request;

class PapuaUniversitasController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $items = PapuaUniversitas::when($q, fn($s) =>
                $s->where('sejarah','like',"%$q%")
                  ->orWhere('visi','like',"%$q%")
                  ->orWhere('misi','like',"%$q%")
            )
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.papua-universitas.index', compact('items','q'));
    }

    public function create()
    {
        return view('admin.papua-universitas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sejarah' => 'nullable|string',
            'visi'    => 'nullable|string',
            'misi'    => 'nullable|string',
        ]);

        PapuaUniversitas::create($data);

        return redirect()->route('admin.papua-universitas.index')
            ->with('success','Data berhasil ditambahkan.');
    }

    public function edit(PapuaUniversitas $papuaUniversitas)
    {
        return view('admin.papua-universitas.edit', compact('papuaUniversitas'));
    }

    public function update(Request $request, PapuaUniversitas $papuaUniversitas)
    {
        $data = $request->validate([
            'sejarah' => 'nullable|string',
            'visi'    => 'nullable|string',
            'misi'    => 'nullable|string',
        ]);

        $papuaUniversitas->update($data);

        return redirect()->route('admin.papua-universitas.index')
            ->with('success','Data berhasil diperbarui.');
    }

    public function destroy(PapuaUniversitas $papuaUniversitas)
    {
        $papuaUniversitas->delete();

        return redirect()->route('admin.papua-universitas.index')
            ->with('success','Data berhasil dihapus.');
    }
}
