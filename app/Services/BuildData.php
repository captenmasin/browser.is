<?php

namespace App\Services;

use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Http\Request;
use \Torann\GeoIP\Location;

class BuildData
{
    public array $data = [];
    public array $deviceData = [];
    public array $browserData = [];
    public array $locationData = [];
    public $type = null;

    public Browser $browser;
    public Request $request;
    public Location $location;

    public function __construct(string $type = null)
    {
        $this->browser = new Browser();
        $this->request = request();
        $this->location = geoip()->getLocation($this->request->ip());
        $this->type = $type;
    }

    public function getData()
    {
        switch ($this->type) {
            case 'device':
                return [
                    'Device' => $this->getDeviceData()
                ];
                break;
            case 'browser':
                return [
                    'Browser' => $this->getBrowserData()
                ];
                break;
            case 'location':
                return [
                    'Location' => $this->getLocationData()
                ];
                break;
            default:
                return [
                    'Device' => $this->getDeviceData(),
                    'Browser' => $this->getBrowserData(),
                    'Location' => $this->getLocationData()
                ];
        }
    }

    public function getDeviceData()
    {
        $device = 'Desktop';
        if ($this->browser::isMobile()) {
            $device = 'Mobile';
        }
        if ($this->browser::isTablet()) {
            $device = 'Tablet';
        }

        return $this->deviceData = [
            'IP address'      => $this->request->ip(),
            'Device'       => $device,
            'User agent'   => $this->browser::getUserAgentString(),
            'OS'           => $this->browser::platformFamily(),
            'OS Version'   => $this->browser::platformVersion(),
            'Device name'  => $this->browser::deviceFamily(),
            'Device model' => $this->browser::deviceModel(),
        ];
    }

    public function getBrowserData()
    {
        return $this->browserData = [
            'Window dimensions' => '',
            'Browser name'    => $this->browser::browserFamily(),
            'Browser version' => $this->browser::browserVersion(),
            'Browser engine'  => $this->browser::browserEngine(),
            'Is Incognito'      => '',
        ];
    }

    public function getLocationData()
    {
        return $this->locationData = [
            'Country Code'    => $this->location->iso_code,
            'Country name'    => $this->location->country,
            'City'            => $this->location->city,
            'Lat/Lng'         => $this->location->lat . ' / ' . $this->location->lon,
        ];
    }
}