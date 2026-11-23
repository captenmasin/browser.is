<?php

namespace App\Console\Commands;

use App\Services\PublicSitemap;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Write the public XML sitemap to public/sitemap.xml';

    public function handle(PublicSitemap $sitemap): int
    {
        $sitemap->build()->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap written to public/sitemap.xml');

        return self::SUCCESS;
    }
}
