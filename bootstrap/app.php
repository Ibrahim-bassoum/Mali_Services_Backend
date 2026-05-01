<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route; // <-- Vérifie que cette ligne est là


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            // Ici on branche ton fichier Client
            Route::middleware('api')
                ->prefix('api/client')
                ->group(base_path('routes/api_client.php'));
            
            // Ici on branche ton fichier Pro
            Route::middleware('api')
                ->prefix('api/pro')
                ->group(base_path('routes/api_pro.php'));

                // Branchement pour l'App Admin (Ne pas l'oublier !)
            Route::middleware('api')
                ->prefix('api/admin')
                ->group(base_path('routes/api_admin.php'));

        },
    )
    ->withMiddleware(function (Middleware $middleware) {
       
    $middleware->api(append: [
        App\Http\Middleware\ForceJsonResponses::class,
            ]);
        })
    
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();