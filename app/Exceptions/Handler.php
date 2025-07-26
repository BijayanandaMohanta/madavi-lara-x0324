<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{

    protected $dontReport = [
        //
    ];


    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }


    public function render($request, Throwable $exception)
    {
        // return parent::render($request, $exception);
        // Modifed for redirecting to home when 404 found
        if ($exception instanceof NotFoundHttpException) {
            return redirect('/');
        }
        
        // if ($exception instanceof HttpExceptionInterface || app()->environment('production')) {
        //     return response()->view('error');
        // }
        
        return parent::render($request, $exception);
    }
}
