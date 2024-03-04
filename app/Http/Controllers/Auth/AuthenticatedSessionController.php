<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

        // Implement role-based redirection similar to your registration logic
        $user = Auth::user(); // Get the authenticated user
        if ($user->hasRole('admin')) {
            return redirect()->route('dashboard'); // Admin dashboard
        } elseif ($user->hasRole('organiser')) {
            return redirect()->route('organizer.profile'); // Organizer profile
        } elseif ($user->hasRole('client')) {
            return redirect()->route('client.profile'); // Client profile
        }

        return redirect('/'); // Default redirection if no role matches
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
