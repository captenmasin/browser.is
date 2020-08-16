<?php

namespace App\Http\Controllers;

use App\Services\BuildData;

class HomeController extends Controller
{
    public function __invoke(String $type = null)
    {
        return view('home', [
            'data' => (new BuildData($type))->getData(),
            'type' => $type
        ]);
    }
}