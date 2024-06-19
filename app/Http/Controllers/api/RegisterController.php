<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Set headers for CORS
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');

        // Handle preflight OPTIONS request
        if ($request->isMethod('options')) {
            return response('', 204);
        }

        // Validate request data
        $request->validate([
            'tingkat_pendidikan' => 'required',
            'provinsi' => 'required',
            'kabupaten_kota' => 'required',
            'nama_sekolah_universitas' => 'required',
            'name' => 'required',
            'tanggal_lahir' => 'required',
            'no_telpon' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        // Store validated data
        $user = [
            'tingkat_pendidikan' => $request->input('tingkat_pendidikan'),
            'provinsi' => $request->input('provinsi'),
            'kabupaten_kota' => $request->input('kabupaten_kota'),
            'nama_sekolah_universitas' => $request->input('nama_sekolah_universitas'),
            'name' => $request->input('name'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'no_telpon' => $request->input('no_telpon'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Insert user into database
        try {
            DB::table('users')->insert($user);
            return response()->json(['message' => 'Registrasi berhasil']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
