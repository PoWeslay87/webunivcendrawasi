<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteStat;
use Illuminate\Http\Request;

class SiteStatController extends Controller
{
    // Tampilkan daftar Site Stats
    public function index()
    {
        $items = SiteStat::orderBy('sort')->paginate(10);
        return view('admin.site-stats.index', compact('items'));
    }

    // Form tambah
    public function create()
    {
        return view('admin.site-stats.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'label'       => 'required|string|max:100',
            'value'       => 'required|integer',
            'suffix'      => 'nullable|string|max:20',
            'headline'    => 'nullable|string|max:150',
            'description' => 'nullable|string|max:500',
            'icon'        => 'nullable|string|max:100',
            'sort'        => 'nullable|integer',
            'is_active'   => 'boolean',
        ]);

        SiteStat::create($data);

        return redirect()->route('admin.site-stats.index')
            ->with('success','Statistik berhasil ditambahkan.');
    }

    // Form edit
    public function edit(SiteStat $siteStat)
    {
        return view('admin.site-stats.edit', compact('siteStat'));
    }

    // Update data
    public function update(Request $request, SiteStat $siteStat)
    {
        $data = $request->validate([
            'label'       => 'required|string|max:100',
            'value'       => 'required|integer',
            'suffix'      => 'nullable|string|max:20',
            'headline'    => 'nullable|string|max:150',
            'description' => 'nullable|string|max:500',
            'icon'        => 'nullable|string|max:100',
            'sort'        => 'nullable|integer',
            'is_active'   => 'boolean',
        ]);

        $siteStat->update($data);

        return redirect()->route('admin.site-stats.index')
            ->with('success','Statistik berhasil diperbarui.');
    }

    // Hapus data
    public function destroy(SiteStat $siteStat)
    {
        $siteStat->delete();

        return redirect()->route('admin.site-stats.index')
            ->with('success','Statistik berhasil dihapus.');
    }
}
