<?php

namespace App\Providers;

use App\Enums\JobStatus;
use App\Mail\BrokenLinksResult;
use App\Models\TrackableJob;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Inertia\Response;
use Laravel\Horizon\Events\JobFailed;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(config('app.debug') !== true) {
            URL::forceScheme('https');
        }

        Response::macro('withMeta', function ($meta) {
            $meta = (object) $meta;
            $title = $meta->title ?? null;
            $description = $meta->description ?? '';
            $image = $meta->image ?? '';
            $canonical = $meta->url ?? null;

            if ($title !== null) {
                SEOTools::setTitle($title);
            }
            if ($canonical !== null) {
                SEOTools::setCanonical($canonical);
            }
            SEOTools::setDescription($description);
            SEOTools::addImages([$image]);

            return $this->with('meta', $meta);
        });


        Queue::after(function (JobProcessed $event) {
            $payload = $event->job->payload();
            $jobData = unserialize($payload['data']['command']);
            $uuid = $jobData->uuid;
            $job = TrackableJob::where('uuid', $uuid)->firstOrFail();
            $job->status = JobStatus::FINISHED;
            $job->info = json_encode($event->job->payload());
            $job->save();
        });
    }
}
