<?php

namespace App\Http\Controllers;

use Browser;
use Request;

use App\Services\BuildData;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', ['data' => (new BuildData())->data]);
    }
}