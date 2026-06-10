<?php

use Illuminate\Support\Facades\Process;
use Illuminate\Process\Exceptions\ProcessFailedException;

test('deploy stops when dependency installation fails', function () {
    Process::fake([
        'pnpm install --frozen-lockfile --silent' => Process::result(exitCode: 1),
        'pnpm run build --silent' => Process::result(),
    ]);

    $this->artisan('app:deploy')->assertFailed();
})->throws(ProcessFailedException::class);
