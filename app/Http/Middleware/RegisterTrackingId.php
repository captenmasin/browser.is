<?php

namespace App\Http\Middleware;

use App\Models\Result;
use Closure;
use Cookie;
use Illuminate\Http\Request;
use Str;
use Symfony\Component\HttpFoundation\Response;

class RegisterTrackingId
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasCookie(config('site.cookie_name'))) {
            return $next($request);
        }

        $cookieUuid = Str::orderedUuid();
        $cookie = Cookie::make(config('site.cookie_name'), $cookieUuid, 5);
        Result::create([
            'uuid' => $cookieUuid,
            'data' => []
        ]);

        return $next($request)->withCookie($cookie);
    }
}
