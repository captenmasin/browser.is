<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ToolController extends BaseController
{
    public function browser(Request $request)
    {
        return Inertia::render('Browser', [

        ])->withMeta([
            'image'       => '',
            'title'       => 'Home',
            'description' => ''
        ]);
    }

    public function device(Request $request)
    {
        return Inertia::render('Device', [

        ])->withMeta([
            'image'       => '',
            'title'       => 'Home',
            'description' => ''
        ]);
    }

    public function location(Request $request)
    {
        return Inertia::render('Location', [

        ])->withMeta([
            'image'       => '',
            'title'       => 'Home',
            'description' => ''
        ]);
    }
}
