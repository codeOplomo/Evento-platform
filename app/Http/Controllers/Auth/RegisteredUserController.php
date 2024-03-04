<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:2,3'], // Specify the role IDs directly
        ]);


        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Attach roles to the user
            $user->roles()->attach($request->role);

            event(new Registered($user));

            Auth::login($user);

            DB::commit();

            // Redirect based on roles
            if ($user->hasRole('organiser')) { // Assuming you have a method to check user roles
                return redirect()->route('organizer.profile');
            } elseif ($user->hasRole('client')) {
                return redirect()->route('client.profile');
            } elseif ($user->hasRole('admin')) {
                return redirect()->route('dashboard');
            }

            return redirect(RouteServiceProvider::HOME);
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'An error occurred during registration. Please try again.']);
        }
    }

}
