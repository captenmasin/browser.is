<?php

if (!function_exists('getDomain')) {
    function getDomain($url): string
    {
        $parse = parse_url($url);
        return $parse['host'];
    }
}
