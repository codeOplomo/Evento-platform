<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $userRoles = Auth::user()->roles->pluck('name')->toArray();

        foreach ($roles as $role) {
            // Check if any of the user's roles match the required roles
            if (in_array($role, $userRoles)) {
                return $next($request);
            }
        }

        // If user does not have any of the required roles, redirect to home
        return redirect('/');
    }
}
