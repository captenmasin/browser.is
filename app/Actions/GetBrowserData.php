<?php

namespace App\Actions;

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

        return [
            'window_dimensions' => [
                'label'       => 'Window dimensions',
                'description' => '',
                'value'        => '',
            ],
            'name' => [
                'label'       => 'Name',
                'description' => '',
                'value'        => $data::browserFamily(),
            ],
            'version' => [
                'label'       => 'Version',
                'description' => '',
                'value'        => $data::browserVersion(),
            ],
            'engine' => [
                'label'       => 'Engine',
                'description' => '',
                'value'        => $data::browserEngine(),
            ],
            'incognito_mode' => [
                'label'       => 'Incognito mode',
                'description' => '',
                'value'        => ''
            ],
        ];
    }

    public function asController(Request $request): array
    {
        return $this->handle();
    }
}
