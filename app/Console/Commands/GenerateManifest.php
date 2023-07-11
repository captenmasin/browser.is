<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateManifest extends Command
{
    protected $signature = 'pwa:generate';

    public function handle(): int
    {
        if (is_link(public_path('images'))) {
            unlink(public_path('images'));
        }

        symlink(resource_path('images'), public_path('images'));

        file_put_contents(public_path('manifest.json'), json_encode(config('pwa.manifest')));
        $this->info('Manifest.json file created');

        return 0;
    }
}
