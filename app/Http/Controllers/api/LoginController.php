<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Log data yang diterima untuk debugging (hanya untuk pengembangan, jangan di produksi)
        \Log::info('Login data: ' . print_r($request->all(), true));

        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // Cari user berdasarkan username atau email
        $user = User::where('username', $username)->orWhere('email', $username)->first();

        // Log user yang ditemukan untuk debugging (hanya untuk pengembangan, jangan di produksi)
        \Log::info('User found: ' . print_r($user, true));

        // Verifikasi password
        if ($user && \Hash::check($password, $user->password)) {
            // Buat token baru untuk user
            $token = $user->createToken('authToken')->accessToken;

            // Hilangkan password sebelum mengirim data ke klien
            $user->makeHidden('password');

            return response()->json([
                'message' => 'Login berhasil',
                'user' => $user,
                'token' => $token,
            ], 200);
        } else {
            return response()->json(['message' => 'Username atau password salah'], 401);
        }
    }
}
