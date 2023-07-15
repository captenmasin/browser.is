<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;

class ToolController extends Controller
{
    public function generate($type, $title = '', ?string $uuid = null, array $meta = []){
        if($uuid && !Result::where('uuid', $uuid)->exists()){
            return redirect()->route($type);
        }

        $routeUuid = $uuid ?? Cookie::get(config('site.cookie_name'));

        return Inertia::render('Tool', [
            'type' => $type,
            'uuid' => $uuid,
            'title' => $title,
            'url' => route($type, ['uuid' => $routeUuid])
        ])->withMeta($meta);
    }

    public function browser(Request $request, ?string $uuid = null)
    {
        return $this->generate('browser', 'Browser', $uuid, [
            'title' => 'Browser',
            'image' => url('/images/social/browser.png')
        ]);
    }

    public function device(Request $request, ?string $uuid = null)
    {
        return $this->generate('device', 'Device', $uuid, [
            'title' => 'Device',
            'image' => url('/images/social/device.png')
        ]);
    }

    public function location(Request $request, ?string $uuid = null)
    {
        return $this->generate('location', 'Location', $uuid, [
            'title' => 'Location',
            'image' => url('/images/social/location.png')
        ]);
    }
}
