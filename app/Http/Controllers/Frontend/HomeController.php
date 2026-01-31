<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        // Tampilkan landing page/frontend
        return view('frontend.home'); // atau view lain yang kamu pakai
    }
}
