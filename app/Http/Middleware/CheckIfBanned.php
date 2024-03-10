<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIfBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_banned) {
            // Log the user out.
            Auth::logout();

            // Redirect them to a specific route or back with an error message.
            return redirect()->route('login')->with('error', 'Your account has been suspended. Please contact support.');
        }

        return $next($request);
    }
}
