<?php

namespace App\Actions;

use App\Enums\Tool;
use Browser;
use App\Models\Result;
use App\Http\Requests\GetDataRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\AsController;

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
        $result = Result::where('uuid', $uuid);
        if($uuid && $result->exists()){
            $data = decrypt($result->first()->data[Tool::Browser]) ?? [];
            return json_decode($data, true);
        }

        return $this->handle();
    }
}
