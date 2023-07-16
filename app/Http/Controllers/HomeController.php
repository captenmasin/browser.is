<?php

namespace App\Http\Controllers;

use App\Services\Helpers;
use Inertia\Inertia;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;
use Str;

class HomeController extends Controller
{
    public function __invoke(Request $request, ?string $uuid = null)
    {
        if($uuid && !Result::where('uuid', $uuid)->exists()){
            abort(404);
        }

        $routeUuid = $uuid ?? Cookie::get(config('site.cookie_name'));
        $result = Result::where('uuid', $uuid)->first();

        $content = Helpers::getContent('home');
        $description = preg_replace( "/\r|\n/", "", $content);

        return Inertia::render('Home', [
            'uuid' => $uuid,
            'date' => $result->updated_at ?? null,
            'content' => $content,
            'url' => route('home', ['uuid' => $routeUuid])
        ])->withMeta([
            'image' => url('/images/social/general.png'),
            'title'       => $result ? 'Results' : 'All info',
            'description' => Str::limit(strip_tags($description), 140)
        ]);
    }
}
