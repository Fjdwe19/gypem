<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Forgot_passwordController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        $user = DB::table('users')->where('email', $email)->first();

        if ($user) {
            $otp = rand(100000, 999999);

            // Simpan OTP ke database
            DB::table('otps')->insert([
                'email' => $email,
                'otp' => $otp,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Kirim OTP ke email
            Mail::raw("OTP: $otp", function($message) use ($email) {
                $message->to($email)
                        ->subject('OTP Anda');
            });

            return response()->json(['message' => 'OTP telah dikirim ke email Anda']);
        } else {
            return response()->json(['message' => 'Email tidak ditemukan'], 404);
        }
    }
}
