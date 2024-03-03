<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'], // Make sure to specify the table name correctly
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:2,3'], // Validate role is either 2 (Organiser) or 3 (Client)
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role, // Assign role_id based on the selected role
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Conditional redirection based on the user's role
        if ($user->role_id == 2) {
            return redirect()->route('organizer.profile'); // Assuming you have a route named 'organizer.dashboard'
        } elseif ($user->role_id == 3) {
            return redirect()->route('client.profile'); // Assuming you have a route named 'client.dashboard'
        }

        return redirect(RouteServiceProvider::HOME);
    }

}
