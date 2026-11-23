<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\PublicSitemap;
use Illuminate\Routing\Controller;

class SitemapController extends Controller
{
    public function __invoke(PublicSitemap $sitemap): Response
    {
        return response($sitemap->build()->render(), 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }
}
