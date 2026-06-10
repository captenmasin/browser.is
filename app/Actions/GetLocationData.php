<?php

namespace App\Actions;

use Str;
use Storage;
use App\Enums\Tool;
use App\Models\Result;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\GetDataRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\AsController;

class GetLocationData
{
    use AsAction;
    use AsController;

    public function handle(string $ip = ''): array
    {
        $data = geoip()->getLocation($ip);

        $mapPath = 'public/map/'.Str::slug($data->lat.'x'.$data->lon).'.png';
        $image = $this->getMapImage($data->lat, $data->lon, $mapPath);

        return [
            'country_code' => [
                'label' => 'Country code',
                'description' => '',
                'value' => $data->iso_code,
            ],
            'country_name' => [
                'label' => 'Country name',
                'description' => '',
                'value' => $data->country,
            ],
            'city' => [
                'label' => 'City',
                'description' => '',
                'value' => $data->city,
            ],
            'state' => [
                'label' => 'State',
                'description' => '',
                'value' => $data->state.' ('.$data->state_name.')',
            ],
            'timezone' => [
                'label' => 'Timezone',
                'description' => '',
                'value' => $data->timezone,
            ],
            'coords' => [
                'label' => 'Coordinates',
                'description' => '',
                'value' => [
                    'lat' => $data->lat,
                    'lon' => $data->lon,
                ],
                'image' => $image,
                'image_url' => 'https://www.google.com/maps/search/'.$data->lat.','.$data->lon,
            ],
        ];
    }

    public function getMapImage(float|string|null $lat, float|string|null $lon, string $mapPath): ?string
    {
        if (Storage::exists($mapPath)) {
            return Storage::url($mapPath);
        }

        $apiKey = config('site.google.maps');

        if (! $apiKey || $lat === null || $lon === null) {
            return null;
        }

        $response = Http::timeout(5)->get('https://maps.googleapis.com/maps/api/staticmap', [
            'size' => '768x350',
            'scale' => 2,
            'zoom' => 14,
            'style' => 'feature:poi|visibility:off',
            'format' => 'png',
            'maptype' => 'roadmap',
            'markers' => 'size:mid|color:red|scale:2|'.$lat.','.$lon,
            'key' => $apiKey,
        ]);

        if (! $response->successful()) {
            return null;
        }

        Storage::put($mapPath, $response->body());

        return Storage::url($mapPath);
    }

    public function asController(GetDataRequest $request, string $uuid = null): array
    {
        $result = Result::where('uuid', $uuid);
        if ($uuid && $result->exists()) {
            $data = ! empty($result->first()->data[Tool::Location]) ? decrypt($result->first()->data[Tool::Location]) : '{}';

            return json_decode($data, true);
        }

        return $this->handle($request->get('ip') ?? $request->ip());
    }
}
