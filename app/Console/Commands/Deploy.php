<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Horizon\Console\TerminateCommand;
use Illuminate\Foundation\Console\ViewCacheCommand;
use Illuminate\Foundation\Console\ViewClearCommand;
use Illuminate\Foundation\Console\RouteCacheCommand;
use Illuminate\Foundation\Console\RouteClearCommand;
use Illuminate\Foundation\Console\ConfigCacheCommand;
use Illuminate\Foundation\Console\ConfigClearCommand;
use Illuminate\Foundation\Console\KeyGenerateCommand;
use Illuminate\Foundation\Console\StorageLinkCommand;
use Illuminate\Database\Console\Migrations\MigrateCommand;

class Deploy extends Command
{
    protected $signature = 'app:deploy';

    protected $description = 'Command description';

    public function handle(): void
    {
        $this->info('Clearing cache');
        $this->call(RouteClearCommand::class);
        $this->call(ViewClearCommand::class);
        $this->call(ConfigClearCommand::class);

        $this->info('Database and storage');
        $this->call(MigrateCommand::class, ['--force' => true]);
        $this->call(StorageLinkCommand::class);

        $this->info('NPM Install and build');
        shell_exec('npm install --no-audit --silent');
        shell_exec('npm run build --no-audit --silent');

        $this->info('Publishing resources');
        $this->call(PublishResources::class);

        $this->info('Generating sitemap');
        $this->call(GenerateSitemap::class);

        $this->info('Regenerating key');
        $this->call(KeyGenerateCommand::class, ['--force' => true]);

//        $this->info('Restarting horizon');
//        $this->call(TerminateCommand::class);

        $this->info('Caching');
        $this->call(RouteCacheCommand::class);
        $this->call(ViewCacheCommand::class);
        $this->call(ConfigCacheCommand::class);
    }
}
