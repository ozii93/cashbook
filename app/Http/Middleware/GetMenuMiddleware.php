<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache; // Gunakan Cache untuk optimalisasi
use App\Models\User; // Pastikan namespace User benar

class GetMenuMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) { // Cek apakah pengguna sudah login
            $user = Auth::user(); // Ambil user yang sedang login

            // Cek apakah cache atau session menu sudah tersedia
            if (!session()->has('user_menu')) {
                if ($user instanceof User) { // Pastikan user adalah instance dari User

                    // Gunakan Cache untuk menyimpan menu berdasarkan ID user
                    $menu = Cache::remember("user_menu_{$user->id}", now()->addMinutes(30), function () use ($user) {
                        return $user->getMenuByRole()->where('is_active', 1);
                    });

                    // Simpan data menu ke dalam session
                    if ($menu->isNotEmpty()) {
                        session([
                            'user_menu' => $menu,
                            'user' => $user->getOriginal(), // Simpan data asli user
                        ]);
                    } else {
                        // Jika menu tidak tersedia, arahkan ke login
                        return redirect()->route('login')->with('error', 'No menu available for your role. Please contact administrator.');
                    }
                } else {
                    // Jika session atau User tidak valid
                    return redirect()->route('login')->with('error', 'Session expired. Please login again.');
                }
            }

            return $next($request); // Lanjutkan ke request berikutnya
        }

        // Jika pengguna belum login
        return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
    }
}
