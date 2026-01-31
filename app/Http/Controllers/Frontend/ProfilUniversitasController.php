<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;  // ✅ ini wajib
use Illuminate\Http\Request;
use App\Models\VisiMisi;
use App\Models\SejarahUniversitas;
use App\Models\Sejarah; 
use App\Models\Akreditasi;
use App\Models\ProgramStudi;

class ProfilUniversitasController extends Controller
{
    public function index()
    {
        $data = VisiMisi::first(); // ambil data pertama
        return view('profil.index', compact('data'));
    }

    public function programStudi()
    {
        $data = ProgramStudi::all();
        return view('frontend.tentang.programstudi', compact('data'));
    }
}
