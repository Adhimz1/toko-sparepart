<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- PASTIKAN INI ADA
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;

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

    // ================== LOGIKA REDIRECT ==================
    $user = Auth::user();

    if ($user->role === 'admin') {
        // Jika role adalah 'admin', arahkan ke rute panel admin
        // dan jangan gunakan intended()
        return redirect()->route('admin.spareparts.index');
    }

    // Jika tidak (role adalah 'user'), arahkan ke tujuan yang dimaksudkan
    // sebelumnya, atau ke dashboard jika tidak ada.
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

        return redirect('/');
    }
}
