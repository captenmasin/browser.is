<?php

namespace App\Services;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class PublicSitemap
{
    public function build(): Sitemap
    {
        $sitemap = Sitemap::create();

        foreach (config('seo.sitemap') as $routeName) {
            $sitemap->add(Url::create(route($routeName)));
        }

        return $sitemap;
    }
}
