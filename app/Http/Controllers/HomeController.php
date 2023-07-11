<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function __invoke(Request $request)
    {
        return Inertia::render('Home', [

        ])->withMeta([
            'image'       => '',
            'title'       => 'Home',
            'description' => ''
        ]);
    }
}
