<?php

namespace App\Services;

use App\Models\Result;
use Illuminate\Support\Str;

class Helpers
{
    public static function getDomain(string $url): string
    {
        return parse_url($url)['host'];
    }

    public static function generateId(): string
    {
        $uuid = (string) Str::uuid();
        if (self::findResult($uuid) !== null) {
            $uuid = self::generateId();
        }

        return $uuid;
    }

    public static function findResult(?string $uuid): ?Result
    {
        if (! $uuid || ! Str::isUuid($uuid)) {
            return null;
        }

        return Result::where('uuid', $uuid)->first();
    }

    public static function getContent(string $filename = ''): ?string
    {
        if (file_exists(resource_path('content/'.$filename.'.md'))) {
            $content = Str::markdown(file_get_contents(resource_path('content/'.$filename.'.md')));

            return Str::replace('<a ', "<a target='_blank' ", $content);
        }

        return null;
    }
}
