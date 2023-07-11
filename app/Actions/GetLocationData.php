<?php

namespace App\Actions;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\AsController;
use Torann\GeoIP\GeoIP;

class GetLocationData
{
    use AsAction;
    use AsController;

    public function handle(string $ip = '')
    {
        $data = geoip()->getLocation($ip);

        return [
            'Country Code' => $data->iso_code,
            'Country name' => $data->country,
            'City'         => $data->city,
            'Lat/Lng'      => $data->lat . ' / ' . $data->lon,
        ];
    }

    public function asController(Request $request, ?string $ip = null): array
    {
        return $this->handle($ip ?? $request->ip());
    }
}
