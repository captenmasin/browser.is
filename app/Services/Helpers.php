<?php

namespace App\Services;

use Str;
use App\Models\Result;

class Helpers
{
    public static function getDomain(string $url): string
    {
        return parse_url($url)['host'];
    }

    public static function generateId($length = 10): string
    {
        $string = Str::random($length);
        if (Result::where('uuid', $string)->exists()) {
            $string = self::generateId($length);
        }

        return $string;
    }

    public static function getContent(string $filename = ''): ?string
    {
        if (file_exists(resource_path('content/'.$filename.'.md'))) {
            $content = Str::markdown(file_get_contents(resource_path('content/'.$filename.'.md')));

            return Str::replace('<a ', "<a target='_blank' ", $content);
        }

        return null;
    }

    public static function getDescription(string $filename = '', int $length = 140): ?string
    {
        $content = Helpers::getContent($filename);
        $content = preg_replace("/\r|\n/", '', $content);

        return Str::limit(strip_tags($content), $length);
    }
}
