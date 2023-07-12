<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Routing\Controller as BaseController;

class ToolController extends BaseController
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
            'title' => 'Browser'
        ]);
    }

    public function device(Request $request, ?string $uuid = null)
    {
        return $this->generate('device', 'Device', $uuid, [
            'title' => 'Device'
        ]);
    }

    public function location(Request $request, ?string $uuid = null)
    {
        return $this->generate('location', 'Location', $uuid, [
            'title' => 'Location'
        ]);
    }
}
