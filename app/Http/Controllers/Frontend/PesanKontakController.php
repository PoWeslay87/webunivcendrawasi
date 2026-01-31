<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PesanKontak;

class PesanKontakController extends Controller
{
    public function create()
    {
        return view('frontend.kontak.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'  => 'required|string|min:3',
            'email' => 'required|email',
            'pesan' => 'required|string|min:5',
        ]);

        PesanKontak::create($data);

        return back()->with('success', 'Pesan terkirim. Terima kasih!');
    }
}
