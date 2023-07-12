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
        $params = $request->route()->parameters();
        if(isset($params['uuid'])
            && Result::where('uuid', $params['uuid'])->first()
            && Cookie::get('results_id') !== $params['uuid']
        ){
            return $next($request);
        }

        $routeName = $request->route()->getName();

        $cookieUuid = Cookie::get('results_id');
        if (Cookie::get('results_id')) {
            $cookie = $cookieUuid;
        } else{
            $cookieUuid = Str::orderedUuid();
            $cookie = Cookie::make('results_id', $cookieUuid, 5);
            Result::create([
                'uuid' => $cookieUuid,
                'data' => []
            ]);
        }

        return redirect()->route($routeName, $cookieUuid)->withCookie($cookie);
    }
}
