<?php

namespace App\Actions;

use App\Enums\Tool;
use BenSampo\Enum\Exceptions\InvalidEnumMemberException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Lorisleiva\Actions\Concerns\AsAction;

class GetShareUrl
{
    use AsAction;

    public function handle(Tool $type, ?string $uuid = null): array
    {
        if(!$uuid){
            $uuid = Cookie::get(config('site.cookie_name'));
        }

        return [
            'url' => route($type->value, ['uuid' => $uuid]),
            'uuid' => $uuid
        ];
    }

    /**
     * @throws InvalidEnumMemberException
     */
    public function asController(Request $request): array
    {
        return $this->handle(new Tool($request->get('type')), $request->get('uuid'));
    }
}
