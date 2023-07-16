<?php

namespace App\Services;

use App\Models\Result;
use Str;

class Helpers
{
    public static function getDomain(string $url): string
    {
        return parse_url($url)['host'];
    }

    public static function generateId($length = 10): string
    {
        $string = Str::random($length);
        if(Result::where('uuid', $string)->exists()){
            $string = self::generateId($length);
        }

        return $string;
    }

    public static function getContent(string $filename = ''): string|null
    {
        if(file_exists(resource_path('content/'.$filename.'.md'))) {
            $content = Str::markdown(file_get_contents(resource_path('content/'.$filename.'.md')));
            return Str::replace("<a ", "<a target='_blank' ", $content);
        }

        return null;
    }
}
