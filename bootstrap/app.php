<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\MiddlewareAdmin;
use App\Http\Middleware\MiddlewareCassier;
use App\Http\Middleware\MiddlewareDocteur;
use App\Http\Middleware\MiddlewarePharmacien;
use App\Http\Middleware\MiddlewareSecretaire;
use App\Http\Middleware\MiddlewareAdminSecretaire;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\MiddlewareSecretaireDocteurs;
use App\Http\Middleware\MiddlewareAdminSecretaireCaissier;
use App\Http\Middleware\MiddlewareAdminSecretaireDocteurs;
use App\Http\Middleware\MiddlewareAdminSecretairePharmacien;
use App\Http\Middleware\MiddlewareCaissierPharmacienDocteurs;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin'=>MiddlewareAdmin::class,
            'secretaire'=>MiddlewareSecretaire::class,
            'pharmacien'=>MiddlewarePharmacien::class,
            'cassier'=>MiddlewareCassier::class,
            'docteur'=>MiddlewareDocteur::class,
            'adminSecretaire'=>MiddlewareAdminSecretaire::class,
            'adminSecretaireDocteurs'=>MiddlewareAdminSecretaireDocteurs::class,
            'secretaireDocteurs'=>MiddlewareSecretaireDocteurs::class,
            'caissierPharmacienDocteurs'=>MiddlewareCaissierPharmacienDocteurs::class,
            'adminSecretairePharmacien'=>MiddlewareAdminSecretairePharmacien::class,
            'adminSecretaireCaissier'=>MiddlewareAdminSecretaireCaissier::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
