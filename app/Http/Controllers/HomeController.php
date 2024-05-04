<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Membuat instance controller baru.
     *
     * @return void
     */
    public function __construct()
    {
        // Menetapkan middleware 'auth' untuk memastikan pengguna terautentikasi
        $this->middleware('auth');
    }

    /**
     * Menampilkan dashboard aplikasi.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Menampilkan tampilan beranda (dashboard)
        return view('home');
    }
}
