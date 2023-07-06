<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

trait IsCacheable
{
    public string $cacheKey = '';
    public int $cacheExpiryHours = 0;
    public string $cacheKeyPrefix = 'cache_';

    public function createCache($data): bool
    {
        $this->cacheExpiryHours = config('app_tools.cacheAge');

        $expiresAt = Carbon::now()->addHours($this->cacheExpiryHours);

        return Cache::put($this->cacheKey, $data, $expiresAt);
    }

    public function cacheExists(): bool
    {
        return Cache::has($this->cacheKey);
    }

    public function getFromCache()
    {
        return Cache::get($this->cacheKey);
    }

    public function setCacheKey($key): void
    {
        $this->cacheKey = $this->cacheKeyPrefix . base64_encode($key);
    }
}
