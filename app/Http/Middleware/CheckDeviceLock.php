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
        $user = Auth::user();

        if ($user && $user->is_premium) {
            $dbFingerprint = $user->browser_fingerprint;
            $cookieFingerprint = $request->cookie('device_fingerprint');

            // 1. If user is premium BUT DB has no fingerprint yet (first login after upgrade or reset)
            // We let them through. The frontend JS will send and lock the fingerprint in the next seconds.
            if (!$dbFingerprint) {
                return $next($request);
            }

            // 2. If DB has a fingerprint, the request MUST have a matching cookie
            // We only check if the cookie exists. If it doesn't exist yet, we wait for JS to set it.
            // But if it DOES exist and doesn't match, we block immediately.
            if ($cookieFingerprint && $cookieFingerprint !== $dbFingerprint) {
                return redirect()->route('device.blocked');
            }
        }

        return $next($request);
    }
}
