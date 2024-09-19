<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class MiddlewareSecretaire
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Gate::allows('secretaire')){
            return $next($request);
        }elseif(Gate::allows('adminSecretaire')){
            return redirect()->route('dashboard');
        }
        return redirect()->route('home');
    }
}
