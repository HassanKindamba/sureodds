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
    if ($request->query('from') === 'chat') {
        session(['login_to_chat' => true]);
    }

    return view('auth.login');
}

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        // ==============================
        // DEVELOPER
        // ==============================
        if ($user->role === 'developer') {
            return redirect('/admin/dev');
        }

        // ==============================
        // MANAGER
        // ==============================
        if ($user->role === 'manager') {
            return redirect('/admin/manager');
        }

        // ==============================
        // CHAT USER
        // Kama alifika login kupitia Chat,
        // mrudishe kwenye Chat.
        // ==============================
        if ($request->session()->pull('login_to_chat', false)) {
            return redirect('/chat');
        }

        // ==============================
        // NORMAL USER
        // User aliye-login kawaida
        // abaki frontend.
        // ==============================
        return redirect()->intended('/');
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