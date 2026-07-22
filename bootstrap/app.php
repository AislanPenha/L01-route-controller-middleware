<?php

use App\Http\Middleware\GlobalEndMiddleware;
use App\Http\Middleware\GlobalStartMiddleware;
use App\Http\Middleware\StartMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // adicionar a todas rotas essa middleware, antes de todas
        // $middleware->prepend([
        //     GlobalStartMiddleware::class,
            // GlobalEndMiddleware::class
        // ]);

        // adicionar a todas rotas essa middleware no final de todas
        // $middleware->append([
            // GlobalStartMiddleware::class,
        //     GlobalEndMiddleware::class
        // ]);

        $middleware->prependToGroup('correr_antes', [
            GlobalStartMiddleware::class,
            GlobalEndMiddleware::class,
        ]);

        $middleware->appendToGroup('correr_depois', [
            GlobalStartMiddleware::class,
            GlobalEndMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
