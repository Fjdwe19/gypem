<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Import model User

class DataController extends Controller
{
    public function index()
    {
        try {
            // Ambil semua data pengguna dari tabel
            $users = User::all(); // Pastikan model User telah didefinisikan dengan benar

            // Kembalikan data dalam format JSON
            return response()->json($users);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
