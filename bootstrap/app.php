<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // --- MULAI TAMBAHAN ---
        // Kita kasih nama 'role' untuk middleware CheckRole tadi
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
        // --- SELESAI TAMBAHAN ---
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();