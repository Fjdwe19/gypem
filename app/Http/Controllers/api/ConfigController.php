<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Import model User

class ConfigController extends Controller
{
    public function fetchData(Request $request)
    {
        // Menggunakan DB facade untuk mengambil data dari database
        try {
            $users = DB::table('users')->get();
            return response()->json($users);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function insertData(Request $request)
    {
        // Contoh validasi dan penyisipan data ke dalam database
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        try {
            DB::table('users')->insert([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json(['message' => 'Data inserted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
