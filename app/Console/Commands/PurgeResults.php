<?php

namespace App\Console\Commands;

use App\Models\Result;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class PurgeResults extends Command
{
    protected $signature = 'app:purge-results';

    public function handle(): void
    {
        $results = Result::all();

        $count = 0;
        foreach ($results as $result){
            if(empty($result->data) || $result->updated_at <= now()->subDays(config('site.keep_results'))->setTime(0, 0, 0)->toDateTimeString()){
                $result->delete();
                $count++;
            }
        }

        $this->info('Deleted ' . $count . ' ' . Str::plural('result', $count));
    }
}
