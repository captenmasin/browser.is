<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function __invoke(Request $request, ?string $uuid)
    {
        dd($uuid, \Cookie::get('results_id'), '99a0aa56-835f-48e0-9c10-03e599b08128');
        return Inertia::render('Home', [
            'uuid' => $uuid
        ])->withMeta([
            'image'       => '',
            'title'       => 'Home',
            'description' => ''
        ]);
    }
}
