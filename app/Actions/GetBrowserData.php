<?php

namespace App\Actions;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\Concerns\AsController;
use hisorange\BrowserDetect\Parser as Browser;

class GetBrowserData
{
    use AsAction;
    use AsController;

    public function handle()
    {
        $data = new Browser();

        return [
            'Window dimensions' => '',
            'Browser name'      => $data::browserFamily(),
            'Browser version'   => $data::browserVersion(),
            'Browser engine'    => $data::browserEngine(),
            'Incognito mode'    => '',
        ];
    }

    public function asController(Request $request): array
    {
        return $this->handle();
    }
}
