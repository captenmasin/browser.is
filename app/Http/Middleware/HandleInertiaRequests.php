<?php

namespace App\Http\Middleware;

use App\Enums\Tool;
use Inertia\Middleware;
use Illuminate\Http\Request;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function share(Request $request): array
    {
        $tools = [];
        foreach (Tool::getInstances() as $key => $tool) {
            $tools[$tool->value] = [
                'url' => route($tool->value),
                'name' => $key,
                'key' => $tool->value,
            ];
        }

        return array_merge(parent::share($request), [
            'currentRoute' => $request->route()?->getName() ?? null,
            'currentUrl' => $request->url(),
            'csrf_token' => csrf_token(),
            'is_results' => $request->route()?->parameter('uuid') !== null ?? null,
            'info' => config('info'),
            'tools' => $tools,
            'enums' => [
                'Tool' => Tool::asArray(),
            ],
            'ziggy' => fn () => array_merge((new Ziggy)->toArray(), [
                'location' => [
                    'host' => $request->getHost(),
                    'pathname' => $request->getPathInfo(),
                    'search' => $request->getQueryString() ? '?'.$request->getQueryString() : '',
                ],
            ]),
        ]);
    }
}
