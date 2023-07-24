<?php

namespace App\Exceptions;

use Throwable;
use Inertia\Inertia;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $e): \Inertia\Response|\Illuminate\Http\Response
    {
        $response = parent::render($request, $e);

        if (in_array($response->status(), [404, 403])) {
            return Inertia::render('Errors/404')->withMeta([
                'title' => 'Error 404',
            ]);
        }

        return $response;
    }

    protected $levels = [
        //
    ];

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
