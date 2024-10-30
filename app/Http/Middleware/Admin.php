<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna sudah login dan memiliki level 'admin'
        if (Auth::check() && Auth::user()->level === 'admin') {
            return $next($request); // Izinkan akses ke halaman admin
        }

        // Jika bukan admin, arahkan ke halaman beranda (/home)
        return redirect()->route('dashboard');
    }
}
