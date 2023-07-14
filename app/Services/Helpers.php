<?php

namespace App\Services;

class Helpers
{
    public static function getDomain(string $url): string
    {
        return parse_url($url)['host'];
    }
}
