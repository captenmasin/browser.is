<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'currentRoute' => $request->route()->getName(),
            'currentUrl'   => $request->url(),
            'is_results' => $request->route()->parameter('uuid') !== null,
            'info'         => config('info'),
            'tools' => [
                'all' => [
                    'url' => route('home'),
                    'name' => 'All'
                ],
                'device' => [
                    'url' => route('device'),
                    'name' => 'Device'
                ],
                'browser' => [
                    'url' => route('browser'),
                    'name' => 'Browser'
                ],
                'location' => [
                    'url' => route('location'),
                    'name' => 'Location'
                ]
            ]
        ]);
    }
}
