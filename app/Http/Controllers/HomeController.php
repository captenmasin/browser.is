<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Cookie;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function __invoke(Request $request, ?string $uuid = null)
    {
        if($uuid && !Result::where('uuid', $uuid)->exists()){
            return redirect()->route('home');
        }

        $routeUuid = $uuid ?? \Illuminate\Support\Facades\Cookie::get(config('site.cookie_name'));

        return Inertia::render('Home', [
            'uuid' => $uuid,
            'url' => route('home', ['uuid' => $routeUuid])
        ])->withMeta([
            'image'       => '',
            'title'       => 'Home',
            'description' => ''
        ]);
    }
}
