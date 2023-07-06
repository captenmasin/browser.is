<?php

use Inertia\Testing\AssertableInertia;

it('has a home page', function () {
    $this->get('/')->assertStatus(200);
    $this->get('/')->assertInertia(function (AssertableInertia $inertia) {
        $inertia->component('Home');
    });
});
