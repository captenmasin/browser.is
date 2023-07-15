<?php

namespace App\Actions;

use App\Http\Requests\GetDataRequest;
use App\Models\Result;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\AsController;
use Torann\GeoIP\GeoIP;

class GetLocationData
{
    use AsAction;
    use AsController;

    public function handle(string $ip = ''): array
    {
        $data = geoip()->getLocation($ip);

        return [
            'country_code' => [
                'label'       => 'Country code',
                'description' => '',
                'value'        => $data->iso_code,
            ],
            'country_name' => [
                'label'       => 'Country name',
                'description' => '',
                'value'        => $data->country,
            ],
            'city' => [
                'label'       => 'City',
                'description' => '',
                'value'        => $data->city,
            ],
            'coords' => [
                'label'       => 'Coordinates',
                'description' => '',
                'value'        => [
                    'lat' => $data->lat,
                    'lon' => $data->lon
                ]
            ],
        ];
    }

    public function asController(GetDataRequest $request, ?string $uuid = null): array
    {
        $result = Result::where('uuid', $uuid);
        if($uuid && $result->exists()){
            $data = $result->first()->data['location'] ?? [];
            return json_decode($data, true);
        }

        return $this->handle($request->get('ip') ?? $request->ip());
    }
}
