<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check() || !Auth::user()->hasRole($role)) {
            // Redirect to a 403 Forbidden page or any other page you prefer
            return redirect('/'); // or use abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
