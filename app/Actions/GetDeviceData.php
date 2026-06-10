<?php

namespace App\Actions;

use App\Enums\Tool;
use App\Services\Helpers;
use App\Http\Requests\GetDataRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\AsController;
use hisorange\BrowserDetect\Parser as Browser;

class GetDeviceData
{
    use AsAction;
    use AsController;

    public function handle(string $ip = ''): array
    {
        $browser = new Browser;
        $device = 'Desktop';
        if ($browser::isMobile()) {
            $device = 'Mobile';
        }
        if ($browser::isTablet()) {
            $device = 'Tablet';
        }

        return [
            'ip_address' => [
                'label' => 'IP Address',
                'description' => '',
                'value' => $ip,
            ],
            'device' => [
                'label' => 'Device',
                'description' => '',
                'value' => $device,
            ],
            'screen_dimensions' => [
                'label' => 'Screen dimensions',
                'description' => '',
                'value' => '',
            ],
            'os' => [
                'label' => 'Operating System',
                'description' => '',
                'value' => $browser::platformFamily().' ('.$browser::platformVersion().')',
            ],
            'device_name' => [
                'label' => 'Device Name',
                'description' => '',
                'value' => $browser::deviceFamily(),
            ],
            'device_model' => [
                'label' => 'Device model',
                'description' => '',
                'value' => $browser::deviceModel(),
            ],
        ];

    }

    public function asController(GetDataRequest $request, ?string $uuid = null): array
    {
        $uuid ??= $request->route('uuid');
        $result = Helpers::findResult($uuid);
        if ($result !== null) {
            $data = ! empty($result->data[Tool::Device]) ? decrypt($result->data[Tool::Device]) : '{}';

            return json_decode($data, true);
        }

        return $this->handle($request->get('ip') ?? $request->ip());
    }
}
