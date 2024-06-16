<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\SecondMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->add('second', SecondMiddleware::class);
        $middleware->alias([
            'second' =>  \App\Http\Middleware\SecondMiddleware::class,
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class
        ]);

        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
