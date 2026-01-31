<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PapuaUniversitas;
use Illuminate\Http\Request;

class PapuaUniversitasController extends Controller
{
    // Tampilkan halaman Sejarah
    public function sejarah()
    {
        $data = PapuaUniversitas::first(); // Ambil data pertama (hanya satu baris)
        return view('frontend.tentang.sejarah', compact('data'));
    }

    // Tampilkan halaman Visi & Misi
    public function visiMisi()
    {
        $data = PapuaUniversitas::first();
        return view('frontend.tentang.visi_misi', compact('data'));
    }
}
