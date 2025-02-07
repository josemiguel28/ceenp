<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        $email = $request->query('email');

        return view('auth.login',
            [
                'email' => $email
            ]
        );
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $ADMIN_ROLE_ID = 1;
        $ESTUDIANTE_ROLE_ID = 2;
        $MAESTRO_ROLE_ID = 3;

        // Redirigir según el rol del usuario
        switch ($request->user()->role_id) {
            case $ADMIN_ROLE_ID:
                return redirect()->intended(route('dashboard', absolute: false));
            case $ESTUDIANTE_ROLE_ID:
                return redirect()->intended(route('estudiante.dashboard.index', absolute: false));
            case $MAESTRO_ROLE_ID:
                return redirect()->intended(route('maestro.dashboard.index', absolute: false));
            default:
                return redirect()->intended(route('/', absolute: false));
        }
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
