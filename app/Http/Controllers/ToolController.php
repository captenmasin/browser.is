<?php

namespace App\Http\Controllers;

use Str;
use Inertia\Inertia;
use App\Models\Result;
use App\Services\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;

class ToolController extends Controller
{
    public function generate($type, $title = '', ?string $uuid = null, array $meta = []){
        if($uuid && !Result::where('uuid', $uuid)->exists()){
            abort(404);
        }

        return Inertia::render('Tool', [
            'type' => $type,
            'uuid' => $uuid,
            'title' => $title,
            'content' => Helpers::getContent($type),
            'url' => route($type, ['uuid' => $uuid ?? Cookie::get(config('site.cookie_name'))])
        ])->withMeta(array_merge($meta, [
            'description' => Helpers::getDescription($type)
        ]));
    }

    public function browser(Request $request, ?string $uuid = null)
    {
        return $this->generate('browser', 'Browser', $uuid, [
            'title' => 'Browser info',
            'image' => url('/images/social/browser.png'),
        ]);
    }

    public function device(Request $request, ?string $uuid = null)
    {
        return $this->generate('device', 'Device', $uuid, [
            'title' => 'Device info',
            'image' => url('/images/social/device.png')
        ]);
    }

    public function location(Request $request, ?string $uuid = null)
    {
        return $this->generate('location', 'Location', $uuid, [
            'title' => 'Location info',
            'image' => url('/images/social/location.png')
        ]);
    }
}
