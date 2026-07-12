<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->prefix('masyarakat')
                ->name('masyarakat.')
                ->group(base_path('routes/masyarakat.php'));

            Route::middleware('web')
                ->prefix('petugas')
                ->name('petugas.')
                ->group(base_path('routes/petugas.php'));

            Route::middleware('web')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectTo(
            guests: '/login',
            users: function () {
                if (\Illuminate\Support\Facades\Auth::check()) {
                    $role = \Illuminate\Support\Facades\Auth::user()->role;
                    if ($role === 'superadmin') {
                        return '/admin/dashboard';
                    } elseif ($role === 'petugas') {
                        return '/petugas/dashboard';
                    }
                }
                return '/masyarakat/dashboard';
            }
        );

        $middleware->alias([
            'role.superadmin' => \App\Http\Middleware\SuperAdminMiddleware::class,
            'role.petugas' => \App\Http\Middleware\PetugasMiddleware::class,
            'role.masyarakat' => \App\Http\Middleware\MasyarakatMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
