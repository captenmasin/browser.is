<?php

use Illuminate\Support\Str;

if(!function_exists('is_staging')){
    function is_staging()
    {
        return Str::contains(url()->current(), 'staging');
    }
}