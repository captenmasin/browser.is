<?php

namespace App\Providers;

use Inertia\Response;
use App\Enums\JobStatus;
use App\Models\TrackableJob;
use Illuminate\Support\Facades\URL;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Support\Facades\Queue;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\ServiceProvider;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Queue\Events\JobProcessed;
use Artesaos\SEOTools\Facades\TwitterCard;

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
        if (config('app.debug') !== true) {
            URL::forceScheme('https');
        }

        config([
            'inertia.pages.paths' => [
                resource_path('js/Pages'),
            ],
        ]);

        Response::macro('withMeta', function (array $meta) {
            $title = $meta['title'] ?? null;
            $description = $meta['description'] ?? '';
            $image = $meta['image'] ?? null;
            $canonical = $meta['url'] ?? null;
            $robots = $meta['robots'] ?? null;

            if (filled($title)) {
                SEOTools::setTitle($title);
                $fullTitle = SEOTools::getTitle();
                OpenGraph::setTitle($fullTitle);
                TwitterCard::setTitle($fullTitle);
                JsonLd::setTitle($fullTitle);
            } else {
                $fullTitle = SEOTools::getTitle();
            }

            SEOTools::setDescription($description);
            JsonLd::setDescription($description);

            if (filled($canonical)) {
                SEOTools::setCanonical($canonical);
                JsonLd::setUrl($canonical);
            }

            OpenGraph::setUrl(url()->current());

            if (filled($robots)) {
                SEOTools::metatags()->setRobots($robots);
            }

            if (filled($image)) {
                OpenGraph::addImage($image);
                TwitterCard::setImage($image);
                JsonLd::setImage($image);
            }

            return $this->with('meta', [
                'title' => $fullTitle,
                'description' => $description,
                'image' => $image,
                'url' => $canonical,
                'robots' => $robots,
            ]);
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
