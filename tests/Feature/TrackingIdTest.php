<?php

use App\Models\Result;
use App\Services\Helpers;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('replaces stale non uuid tracking cookies', function () {
    $response = $this->withCookie(config('site.cookie_name'), 'xvQdV7zJQz')->get('/');

    $response->assertOk();
    $response->assertCookie(config('site.cookie_name'));

    $uuid = Result::sole()->uuid;

    expect(Str::isUuid($uuid))->toBeTrue()
        ->and($uuid)->not->toBe('xvQdV7zJQz');
});

it('does not query results with non uuid values', function () {
    expect(Helpers::findResult('xvQdV7zJQz'))->toBeNull();
});
