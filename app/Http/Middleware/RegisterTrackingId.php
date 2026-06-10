<?php

namespace App\Http\Middleware;

use Cookie;
use Closure;
use App\Models\Result;
use App\Services\Helpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterTrackingId
{
    public function handle(Request $request, Closure $next): Response
    {
        $cookieName = config('site.cookie_name');

        if (Helpers::findResult($request->cookie($cookieName)) !== null) {
            return $next($request);
        }

        $cookieUuid = Helpers::generateId();
        $cookie = Cookie::make($cookieName, $cookieUuid, 5);
        Result::create([
            'uuid' => $cookieUuid,
            'data' => [],
        ]);

        return $next($request)->withCookie($cookie);
    }
}
