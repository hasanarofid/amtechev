<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
         $middleware->validateCsrfTokens(except: [
             'checkout/callback',
         ]);

         $middleware->alias([
             'role' => \App\Http\Middleware\RoleMiddleware::class,
             'admin' => \App\Http\Middleware\AdminMiddleware::class,
             'member' => \App\Http\Middleware\MemberMiddleware::class,
         ]);

         $middleware->redirectGuestsTo(fn (Request $request) => $request->is('admin/*') || $request->is('admin') || $request->is('dashboard') ? route('login') : route('user.login'));
         
         $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Illuminate\Http\Exceptions\PostTooLargeException $e, $request) {
            return redirect()->back()->withErrors(['error' => 'The uploaded file or pasted content is too large. Please reduce the size and try again.'])->withInput();
        });
    })->create();
