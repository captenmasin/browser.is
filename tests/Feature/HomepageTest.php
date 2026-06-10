<?php

use Inertia\Testing\AssertableInertia;

it('renders the home page', function () {
    $this->get('/')
        ->assertOk()
        ->assertInertia(fn (AssertableInertia $inertia) => $inertia->component('Home'));
});
