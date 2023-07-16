<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Response;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $e): \Inertia\Response|\Illuminate\Http\Response
    {
        $response = parent::render($request, $e);

        if ($response->status() === 404) {
            return Inertia::render('Errors/404')->withMeta([
                'title' => 'Error 404'
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
