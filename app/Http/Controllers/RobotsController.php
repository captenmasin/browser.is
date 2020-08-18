<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;

class RobotsController extends Controller
{
    public function __invoke(string $type = null)
    {
        if(is_staging()) {
            $contents = 'User-agent: *' . PHP_EOL . 'Disallow: /';
        } else {
            $contents = 'User-agent: *' . PHP_EOL . 'allow: /';
        }
        $response = Response::make($contents, 200);
        $response->header('Content-Type', 'text/plain');
        return $response;
    }
}