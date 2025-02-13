<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $this->clearAllCache();

        return redirect('/');
    }
    protected function clearAllCache()
    {
        Artisan::call('cache:clear');     // Hapus cache aplikasi
        Artisan::call('config:clear');    // Hapus cache konfigurasi
        Artisan::call('route:clear');     // Hapus cache routing
        Artisan::call('view:clear');      // Hapus cache tampilan
    }
    protected function authenticated(Request $request, $user)
    {
        $menu = $user->getMenuByRole(); // Dapatkan menu berdasarkan role
        session(['user_menu' => $menu->where('is_active', 1), 'user' => $user->getOriginal()]); // Simpan di session
    }
}
