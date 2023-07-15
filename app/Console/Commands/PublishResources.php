<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PublishResources extends Command
{
    protected $signature = 'resources:publish';

    public function handle(): int
    {
        if (is_link(public_path('images'))) {
            unlink(public_path('images'));
        }

        symlink(resource_path('images'), public_path('images'));

        file_put_contents(public_path('ads.txt'), config('site.ads.text'));

        $this->info('Images moved to public');

        return 0;
    }
}
