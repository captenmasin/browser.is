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
            'IP address'   => $ip,
            'Device'       => $device,
            'User agent'   => $browser::getUserAgentString(),
            'OS'           => $browser::platformFamily(),
            'OS Version'   => $browser::platformVersion(),
            'Device name'  => $browser::deviceFamily(),
            'Device model' => $browser::deviceModel(),
        ];

    }

    public function asController(Request $request, ?string $ip = null): array
    {
        return $this->handle($ip ?? $request->ip());
    }
}
