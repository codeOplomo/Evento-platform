<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                
                $role_id = Auth::guard($guard)->user()->role_id;
                if ($role_id == 1) {
                    return redirect('/admin-dashboard');
                } elseif ($role_id == 2) {
                    return redirect('/organizer-profile');
                } elseif ($role_id == 3) {
                    return redirect('/client-profile');
                }
            }
        }

        return $next($request);
    }
}
