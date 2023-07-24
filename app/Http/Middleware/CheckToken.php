<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckToken
{
    public function handle(Request $request, Closure $next): Response|array
    {
        $token = $request->get('_token');
        if (! $token || ($token !== csrf_token())) {
            abort(419);
        }

        return $next($request);
    }
}
