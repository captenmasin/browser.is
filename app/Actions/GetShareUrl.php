<?php

namespace App\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Lorisleiva\Actions\Concerns\AsAction;

class GetShareUrl
{
    use AsAction;

    public function handle(?string $type = '', ?string $uuid = null)
    {
        if(!$uuid){
            $uuid = Cookie::get(config('site.cookie_name'));
        }

        return [
            'url' => route($type, ['uuid' => $uuid])
        ];
    }

    public function asController(Request $request): array
    {
        return $this->handle($request->get('type'), $request->get('uuid'));
    }
}
