<?php

namespace App\Actions;

use App\Enums\Tool;
use App\Models\Result;
use App\Http\Requests\GetDataRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\AsController;
use Storage;
use Str;

class GetLocationData
{
    use AsAction;
    use AsController;

    public function handle(string $ip = ''): array
    {
        $data = geoip()->getLocation($ip);

        $mapImage = 'https://maps.googleapis.com/maps/api/staticmap?size=768x350&scale=2&zoom=14&style=feature:poi|visibility:off&format=png&maptype=roadmap&markers=size:mid%7Ccolor:red%scale:2%7C'.$data->lat.','.$data->lon.'&key='.config('site.google.maps');

        if(!Storage::exists('public/map/' . Str::slug($data->lat.'x'.$data->lon) . '.png')){
            Storage::put('public/map/' . Str::slug($data->lat.'x'.$data->lon) . '.png', file_get_contents($mapImage));
        }

        $image = Storage::url('public/map/' . Str::slug($data->lat.'x'.$data->lon) . '.png');

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
