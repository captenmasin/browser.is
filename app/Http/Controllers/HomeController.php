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
                Describe what browser.is does and what it can be used for
            </p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce varius interdum nibh, ac tempus enim accumsan sed. Curabitur leo mi, gravida et ante quis, blandit accumsan eros. Integer ut ligula pulvinar magna imperdiet sollicitudin. Ut fringilla urna tellus, ac aliquet elit dictum sed. Suspendisse suscipit libero odio, congue porta elit lacinia vel.
            </p>
            <h2>
                Lorem ipsum
            </h2>
            <p>
                Integer interdum eros leo, et maximus nisl ullamcorper ac. Nulla erat ante, bibendum ac vulputate et, facilisis at sem. Donec vitae suscipit tellus. Donec egestas ultrices velit ut consectetur. Nunc at porttitor sapien. Nam lobortis magna sit amet dignissim scelerisque. Quisque et nibh ut tortor euismod aliquam vel ut dui. Pellentesque condimentum sodales semper. Aenean sollicitudin varius leo ac rutrum.
            </p>
            <p>
                Nulla posuere a orci eu ultrices. Phasellus condimentum eu dolor et condimentum. Maecenas tortor massa, maximus non mi eu, ultrices elementum mauris. Suspendisse lacinia tellus lacus, sit amet consequat turpis congue ut. Mauris vel tristique neque. Cras vehicula orci commodo purus convallis, vel aliquam leo mollis. Morbi nisl libero, sodales eu nisl eget, pulvinar pretium est.
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
