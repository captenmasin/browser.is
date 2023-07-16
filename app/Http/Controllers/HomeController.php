<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function __invoke(Request $request, ?string $uuid = null)
    {
        if($uuid && !Result::where('uuid', $uuid)->exists()){
            return redirect()->route('home');
        }

        $routeUuid = $uuid ?? Cookie::get(config('site.cookie_name'));
        $result = Result::where('uuid', $uuid)->first();

        $content = <<<HTML
<p>
             Browser.is is a user-friendly and convenient tool designed to provide detailed information about your browser, device, and location. It offers a quick and accessible way to display and share relevant data, allowing users to gain insights into their browsing environment.
</p>
<p>
With Browser.is, you can effortlessly retrieve essential information about your browser, such as its name, version, and supported technologies. It also offers insights into your device, including the operating system, screen resolution, and available memory. Additionally, Browser.is can provide data about your internet connection, including your IP address and network type.
</p>
<p>
One of the notable features of Browser.is is its ability to determine your location based on your IP address. This information can be particularly useful for various applications, such as personalized content delivery or geographically targeted services.
</p>
<p>
The tool is designed to be easy to use, requiring no installation or complex configurations. Simply accessing the Browser.is website will present you with a comprehensive overview of your browser, device, and location data in a user-friendly interface. You can also easily share this information with others by sharing the provided URL or exporting the data as a PDF.
</p>
<p>
Whether you're a web developer, a tech enthusiast, or simply curious about your browsing environment, Browser.is offers a hassle-free solution to gather and share essential information about your browser, device, and location.
</p>
HTML;

        return Inertia::render('Home', [
            'uuid' => $uuid,
            'date' => $result->updated_at ?? null,
            'content' => $content,
            'url' => route('home', ['uuid' => $routeUuid])
        ])->withMeta([
            'image' => url('/images/social/general.png'),
            'title'       => $result ? 'Results' : 'All info',
            'description' => ''
        ]);
    }
}
