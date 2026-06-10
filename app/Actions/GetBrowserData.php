<?php

namespace App\Actions;

use Browser;
use App\Enums\Tool;
use App\Services\Helpers;
use App\Http\Requests\GetDataRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\AsController;

class GetBrowserData
{
    use AsAction;
    use AsController;

    public function handle(): array
    {
        $data = new Browser;

        $data = [
            'window_dimensions' => [
                'label' => 'Window dimensions',
                'description' => '',
                'value' => '',
            ],
            'name' => [
                'label' => 'Name',
                'description' => '',
                'value' => $data::browserFamily().' ('.$data::browserVersion().')',
            ],
            'engine' => [
                'label' => 'Engine',
                'description' => '',
                'value' => $data::browserEngine(),
            ],
            'user_agent' => [
                'label' => 'User agent',
                'description' => '',
                'value' => $data::userAgent(),
            ],
            'time' => [
                'label' => 'Local time',
                'description' => '',
                'value' => '',
            ],
        ];

        SaveResults::run('browser', $data);

        return $data;
    }

    public function asController(GetDataRequest $request, ?string $uuid = null): array
    {
        $uuid ??= $request->route('uuid');
        $result = Helpers::findResult($uuid);
        if ($result !== null) {
            $data = ! empty($result->data[Tool::Browser]) ? decrypt($result->data[Tool::Browser]) : '{}';

            return json_decode($data, true);
        }

        return $this->handle();
    }
}
