<?php

use App\Actions\GetLocationData;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

it('omits the static map image when no google maps key is configured', function () {
    Storage::fake('local');
    Config::set('site.google.maps', null);

    $action = new GetLocationData();
    $image = $action->getMapImage(41.31, -72.92, 'public/map/test.png');

    expect($image)->toBeNull();
    Storage::assertMissing('public/map/test.png');
});

it('omits the static map image when google rejects the request', function () {
    Storage::fake('local');
    Config::set('site.google.maps', 'invalid-key');
    Http::fake([
        'maps.googleapis.com/*' => Http::response('Forbidden', 403),
    ]);

    $action = new GetLocationData();
    $image = $action->getMapImage(41.31, -72.92, 'public/map/test.png');

    expect($image)->toBeNull();
    Storage::assertMissing('public/map/test.png');
});
