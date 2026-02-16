<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Allow if user is admin OR if we are currently in impersonation mode
        if (Auth::check() && ((bool) Auth::user()->is_admin === true || session()->has('impersonated_by'))) {
            return $next($request);
        }

        abort(403, 'UNAUTHORIZED ACCESS.');
    }
}
