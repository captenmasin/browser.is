<?php

use App\Models\Result;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
});

function documentHead(string $path): string
{
    $html = test()->get($path)->assertOk()->getContent();

    expect($html)->toContain('<head>');

    preg_match('/<head>(.*)<\/head>/s', $html, $matches);

    return $matches[1];
}

it('uses unique sensible page descriptions', function () {
    $descriptions = [];

    foreach (config('seo.pages') as $page) {
        expect(mb_strlen($page['title']))->toBeLessThan(60)
            ->and($page['title'])->not->toContain('—');

        foreach (['description', 'shared_description'] as $key) {
            if (! isset($page[$key])) {
                continue;
            }

            $descriptions[] = $page[$key];

            expect(mb_strlen($page[$key]))->toBeGreaterThan(80)
                ->and(mb_strlen($page[$key]))->toBeLessThan(170)
                ->and($page[$key])->not->toContain('—')
                ->and($page[$key])->not->toEndWith('...');
        }
    }

    expect(array_unique($descriptions))->toHaveCount(count($descriptions));
});

it('renders unique server side tags for public pages', function (string $path, string $page) {
    $definition = config("seo.pages.{$page}");
    $title = $definition['title'].' - '.config('app.name');
    $description = $definition['description'];
    $image = url($definition['image']);
    $canonical = route($definition['route']);
    $head = documentHead($path);

    expect(substr_count($head, '<title>'))->toBe(1)
        ->and($head)->toContain('<title>'.$title.'</title>')
        ->and(substr_count($head, 'name="description"'))->toBe(1)
        ->and($head)->toContain('name="description" content="'.$description.'"')
        ->and(substr_count($head, 'property="og:title"'))->toBe(1)
        ->and($head)->toContain('property="og:title" content="'.$title.'"')
        ->and($head)->toContain('property="og:description" content="'.$description.'"')
        ->and(substr_count($head, 'property="og:image"'))->toBe(1)
        ->and($head)->toContain('property="og:image" content="'.$image.'"')
        ->and(substr_count($head, 'name="twitter:title"'))->toBe(1)
        ->and($head)->toContain('name="twitter:title" content="'.$title.'"')
        ->and(substr_count($head, 'name="twitter:image"'))->toBe(1)
        ->and($head)->toContain('name="twitter:image" content="'.$image.'"')
        ->and($head)->toContain('name="twitter:card" content="summary_large_image"')
        ->and($head)->not->toContain('twitter:image0')
        ->and($head)->not->toContain('twitter:images')
        ->and($head)->not->toContain('twitter:site')
        ->and(substr_count($head, 'rel="canonical"'))->toBe(1)
        ->and($head)->toContain('<link rel="canonical" href="'.$canonical.'">')
        ->and($head)->not->toContain('name="robots"')
        ->and($head)->toContain('"name":"'.$title.'"')
        ->and($head)->toContain('"description":"'.$description.'"')
        ->and(substr_count($head, 'application/ld+json'))->toBe(1);
})->with([
    'home' => ['/', 'home'],
    'browser' => ['/browser', 'browser'],
    'device' => ['/device', 'device'],
    'location' => ['/location', 'location'],
]);

it('noindexes shared result pages and points their canonical url at the public page', function (string $base, string $page) {
    $uuid = (string) Str::uuid();

    Result::create([
        'uuid' => $uuid,
        'data' => [],
    ]);

    $path = rtrim($base, '/').'/'.$uuid;
    $definition = config("seo.pages.{$page}");
    $title = $definition['shared_title'].' - '.config('app.name');
    $head = documentHead($path);

    expect($head)->toContain('<title>'.$title.'</title>')
        ->and($head)->toContain('name="description" content="'.$definition['shared_description'].'"')
        ->and($head)->toContain('name="robots" content="noindex, follow"')
        ->and($head)->toContain('<link rel="canonical" href="'.route($definition['route']).'">')
        ->and($head)->not->toContain('<link rel="canonical" href="'.url($path).'">')
        ->and($head)->toContain('property="og:url" content="'.url($path).'"');
})->with([
    'home' => ['/', 'home'],
    'browser' => ['/browser', 'browser'],
    'device' => ['/device', 'device'],
    'location' => ['/location', 'location'],
]);

it('noindexes missing pages', function () {
    $title = config('seo.pages.missing.title').' - '.config('app.name');
    $head = documentHead('/not-a-real-page');

    expect($head)->toContain('<title>'.$title.'</title>')
        ->and($head)->toContain('name="description" content="'.config('seo.pages.missing.description').'"')
        ->and($head)->toContain('name="robots" content="noindex, follow"')
        ->and($head)->toContain('<link rel="canonical" href="'.url('/not-a-real-page').'">');
});

it('includes a twitter site tag only when a handle is configured', function () {
    config(['seotools.twitter.defaults.site' => '@browseris']);

    $head = documentHead('/');

    expect($head)->toContain('name="twitter:site" content="@browseris"')
        ->and(substr_count($head, 'twitter:site'))->toBe(1);
});

it('serves an xml sitemap of the public pages', function () {
    $uuid = (string) Str::uuid();

    Result::create([
        'uuid' => $uuid,
        'data' => [],
    ]);

    $response = $this->get('/sitemap.xml');

    $response->assertOk();
    $response->assertHeader('Content-Type', 'application/xml; charset=UTF-8');

    $body = $response->getContent();

    expect($body)->toStartWith('<?xml')
        ->and($body)->toContain('<urlset')
        ->and($body)->not->toContain('<html')
        ->and($body)->toContain(route('home'))
        ->and($body)->toContain(route('browser'))
        ->and($body)->toContain(route('device'))
        ->and($body)->toContain(route('location'))
        ->and($body)->not->toContain($uuid)
        ->and(substr_count($body, '<loc>'))->toBe(4);
});

it('points robots.txt at the sitemap', function () {
    $response = $this->get('/robots.txt');

    $response->assertOk();
    $response->assertHeader('Content-Type', 'text/plain; charset=UTF-8');

    $body = $response->getContent();

    expect($body)->toContain("User-agent: *\nDisallow:")
        ->and($body)->toContain('Sitemap: '.url('/sitemap.xml'))
        ->and($body)->not->toContain('<html');
});

it('writes the same public sitemap from the artisan command', function () {
    $path = public_path('sitemap.xml');

    if (file_exists($path)) {
        unlink($path);
    }

    $this->artisan('sitemap:generate')->assertSuccessful();

    $contents = file_get_contents($path);

    expect($contents)->toContain('<?xml')
        ->and($contents)->toContain(route('home'))
        ->and($contents)->toContain(route('location'))
        ->and(substr_count($contents, '<loc>'))->toBe(4);

    unlink($path);
});
