<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards; // Mengatur default guards jika tidak ada yang diberikan

                foreach ($guards as $guard) { // Melakukan iterasi pada daftar guards
                    if (Auth::guard($guard)->check()) { // Memeriksa apakah pengguna telah terautentikasi dengan guard tertentu
                return redirect(RouteServiceProvider::HOME); // Mengarahkan pengguna ke halaman HOME jika terautentikasi
            }
        }

        return $next($request); // Melanjutkan request ke middleware atau handler selanjutnya

    }
}
