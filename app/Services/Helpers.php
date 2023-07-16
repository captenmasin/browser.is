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
}
