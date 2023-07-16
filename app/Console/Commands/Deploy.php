<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Console\Migrations\MigrateCommand;
use Illuminate\Foundation\Console\KeyGenerateCommand;
use Illuminate\Foundation\Console\RouteCacheCommand;
use Illuminate\Foundation\Console\RouteClearCommand;
use Illuminate\Foundation\Console\ViewCacheCommand;
use Illuminate\Foundation\Console\ViewClearCommand;

class Deploy extends Command
{
    protected $signature = 'app:deploy';

    protected $description = 'Command description';

    public function handle()
    {
        $this->call(RouteClearCommand::class);
        $this->call(ViewClearCommand::class);

        $this->call('migrate --force');
        $this->call('storage:link');

        shell_exec('npm install');
        shell_exec('npm run build');

        $this->call(PublishResources::class);
        $this->call(GenerateSitemap::class);

        $this->call(KeyGenerateCommand::class);

        $this->call(RouteCacheCommand::class);
        $this->call(ViewCacheCommand::class);
    }
}
