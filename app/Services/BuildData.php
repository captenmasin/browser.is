<?php

namespace App\Services;

use Browser;
use Request;

class BuildData{
    public array $data = [];

    public function __construct()
    {
        $device = 'Desktop';
        if (Browser::isMobile()) {
            $device = 'Mobile';
        }
        if (Browser::isTablet()) {
            $device = 'Tablet';
        }
        $location = geoip()->getLocation(Request::ip());
        $this->data = [
            'Device'            => $device,
            'Browser name'      => Browser::browserFamily(),
            'Browser version'   => Browser::browserVersion(),
            'Browser engine'    => Browser::browserEngine(),
            'Incognito or no'   => '',
            'IP address'        => Request::ip(),
            'Country Code'      => $location->iso_code,
            'Country name'      => $location->country,
            'City'              => $location->city,
            'Lat/Lng'           => $location->lat . ' / ' . $location->lon,
            'OS'                => Browser::platformFamily(),
            'OS Version'        => Browser::platformVersion(),
            'Device name'       => Browser::deviceFamily(),
            'Device model'       => Browser::deviceModel(),
            'Window dimensions' => '<span id="window_dimensions"></span>',
        ];
    }
}