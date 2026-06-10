<?php

use Torann\GeoIP\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache as CacheFacade;

it('can construct the geoip cache with the default file store', function () {
    Config::set('cache.default', 'file');
    Config::set('geoip.cache_tags', []);

    $cache = new Cache(
        app('cache'),
        config('geoip.cache_tags'),
        config('geoip.cache_expires')
    );

    expect($cache)->toBeInstanceOf(Cache::class);
    expect(CacheFacade::store()->supportsTags())->toBeFalse();
});
