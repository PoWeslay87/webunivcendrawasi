<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PesanKontak;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PesanKontakController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:kontak_view', only: ['index','show']),
            new Middleware('permission:kontak_edit', only: ['update']),
            new Middleware('permission:kontak_delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $kontak = PesanKontak::latest()->paginate(20);
        return view('admin.kontak.index', compact('kontak'));
    }

    public function show(PesanKontak $pesanKontak)
    {
        return view('admin.kontak.show', ['kontak' => $pesanKontak]);
    }

    public function update(Request $request, PesanKontak $pesanKontak)
    {
        $pesanKontak->update(['dibaca' => true]); // asumsikan ada kolom 'dibaca'
        return back()->with('success', 'Pesan diperbarui.');
    }

    public function destroy(PesanKontak $pesanKontak)
    {
        $pesanKontak->delete();
        return redirect()->route('admin.kontak.index')->with('success', 'Pesan dihapus.');
    }
}
