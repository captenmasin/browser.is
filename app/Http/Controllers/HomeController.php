<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Inertia\Inertia;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function __invoke(Request $request, ?string $uuid = null)
    {
        if($uuid && !Result::where('uuid', $uuid)->exists()){
            return redirect()->route('home');
        }

        $routeUuid = $uuid ?? Cookie::get(config('site.cookie_name'));
        $result = Result::where('uuid', $uuid)->first();

        return Inertia::render('Home', [
            'uuid' => $uuid,
            'date' => $result->updated_at ?? null,
            'url' => route('home', ['uuid' => $routeUuid])
        ])->withMeta([
            'image'       => '',
            'title'       => 'All',
            'description' => ''
        ]);
    }
}
