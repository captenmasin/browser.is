<?php

namespace App\Actions;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\AsController;
use hisorange\BrowserDetect\Parser as Browser;

class GetDeviceData
{
    use AsAction;
    use AsController;

    public function handle(string $ip = ''): array
    {
        $browser = new Browser();
        $device = 'Desktop';
        if ($browser::isMobile()) {
            $device = 'Mobile';
        }
        if ($browser::isTablet()) {
            $device = 'Tablet';
        }

        return [
            'ip_address' => [
                'label'       => 'IP Address',
                'description' => '',
                'value'        => $ip
            ],
            'device' => [
                'label'       => 'Device',
                'description' => '',
                'value'        => $device
            ],
            'user_agent' => [
                'label'       => 'User agent',
                'description' => '',
                'value'        => $browser::getUserAgentString(),
            ],
            'os' => [
                'label'       => 'Operating System',
                'description' => '',
                'value'        => $browser::platformFamily(),
            ],
            'os_version' => [
                'label'       => 'Operating System Version',
                'description' => '',
                'value'        => $browser::platformVersion(),
            ],
            'device_name' => [
                'label'       => 'Device Name',
                'description' => '',
                'value'        => $browser::deviceFamily(),
            ],
            'device_model' => [
                'label'       => 'Device model',
                'description' => '',
                'value'        => $browser::deviceModel(),
            ],
        ];

    }

    public function asController(Request $request, ?string $ip = null): array
    {
        return $this->handle($ip ?? $request->ip());
    }
}
