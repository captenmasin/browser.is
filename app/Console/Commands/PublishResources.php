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

        $this->info('Images moved to public');

        return 0;
    }
}
