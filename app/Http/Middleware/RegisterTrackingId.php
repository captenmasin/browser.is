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
        if ($request->hasCookie(config('site.cookie_name'))) {
            return $next($request);
        }

        $cookieUuid = Helpers::generateId();
        $cookie = Cookie::make(config('site.cookie_name'), $cookieUuid, 5);
        Result::create([
            'uuid' => $cookieUuid,
            'data' => [],
        ]);

        return $next($request)->withCookie($cookie);
    }
}
