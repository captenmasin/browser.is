<?php

namespace App\Http\Controllers;

use App\Enums\Tool;
use Inertia\Inertia;
use App\Models\Result;
use App\Services\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;

class ToolController extends Controller
{
    public function tool(Tool $type, ?string $uuid = null)
    {
        if ($uuid && !Result::where('uuid', $uuid)->exists()) {
            abort(404);
        }

        $url = route($type->value, ['uuid' => $uuid ?? Cookie::get(config('site.cookie_name'))]);

        return Inertia::render('Tool', [
            'url'     => $url,
            'type'    => $type->value,
            'uuid'    => $uuid,
            'title'   => $type->key,
            'content' => Helpers::getContent($type->value)
        ])->withMeta([
            'title'       => $type->key . ' info',
            'description' => Helpers::getDescription($type->value),
            'image'       => url('/images/social/' . $type->value . '.png')
        ]);
    }

    public function browser(Request $request, ?string $uuid = null)
    {
        return $this->tool(new Tool(Tool::Browser), $uuid);
    }

    public function device(Request $request, ?string $uuid = null)
    {
        return $this->tool(new Tool(Tool::Device), $uuid);
    }

    public function location(Request $request, ?string $uuid = null)
    {
        return $this->tool(new Tool(Tool::Location), $uuid);
    }
}
