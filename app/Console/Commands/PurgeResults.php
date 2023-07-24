<?php

namespace App\Console\Commands;

use App\Models\Result;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class PurgeResults extends Command
{
    protected $signature = 'app:purge-results';

    public function handle(): void
    {
        $results = Result::all();

        $count = 0;
        foreach ($results as $result) {
            $data = decrypt($result->data);
            if (
                (empty($data) || $result->updated_at <= now()->subHour()->toDateTimeString())
                || $result->updated_at <= now()->subDays(config('site.keep_results'))->setTime(0, 0, 0)->toDateTimeString()) {
                $result->delete();
                $count++;
            }
        }

        $this->info('Deleted '.$count.' '.Str::plural('result', $count));
    }
}
