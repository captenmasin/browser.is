<?php

namespace App\Actions;

use App\Http\Requests\GetDataRequest;
use App\Models\Result;
use Cookie;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\AsController;
use Browser;

class GetBrowserData
{
    use AsAction;
    use AsController;

    public function handle(): array
    {
        $data = new Browser();

        $data = [
            'window_dimensions' => [
                'label'       => 'Window dimensions',
                'description' => '',
                'value'       => '',
            ],
            'name'              => [
                'label'       => 'Name',
                'description' => '',
                'value'       => $data::browserFamily(),
            ],
            'version'           => [
                'label'       => 'Version',
                'description' => '',
                'value'       => $data::browserVersion(),
            ],
            'engine'            => [
                'label'       => 'Engine',
                'description' => '',
                'value'       => $data::browserEngine(),
            ],
            'incognito_mode'    => [
                'label'       => 'Incognito mode',
                'description' => '',
                'value'       => ''
            ],
            'time'              => [
                'label'       => 'Local time',
                'description' => '',
                'value'       => ''
            ],
        ];

        SaveResults::run('browser', $data);

        return $data;
    }

    public function asController(GetDataRequest $request, ?string $uuid = null): array
    {
        if($uuid && Result::where('uuid', $uuid)->exists()){
            return Result::where('uuid', $uuid)->first()->data['browser'];
        }

        return $this->handle();
    }
}
