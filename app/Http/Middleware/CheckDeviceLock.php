<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CheckDeviceLock
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_premium) {
            $user = Auth::user();
            $cookieName = 'premium_device_token_' . $user->id; // Unique per user

            $currentCookie = $request->cookie($cookieName);

            if (!$user->device_token) {
                // If user has no token in DB (first login as premium or after reset)

                // Check if cookie exists. If yes, that's weird (maybe leftover), but better overwrite.

                $newToken = (string) Str::uuid();

                // Update DB
                $user->device_token = $newToken;
                $user->save();

                // Set cookie forever (10 years)
                Cookie::queue(Cookie::forever($cookieName, $newToken));

            } else {
                // User has a token in DB.
                // Request MUST have the matching cookie.

                if (!$currentCookie || $currentCookie !== $user->device_token) {
                    // Security Violation
                    Auth::logout();

                    // Invalidate session
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    return redirect()->route('login')->withErrors([
                        'email' => 'Access Denied: Your Premium account is locked to another device. Please use your registered device.'
                    ]);
                }
            }
        }

        return $next($request);
    }
}
