<?php

namespace App\Http\Middleware;
use \App\Http\Controllers;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use \Auth;
class monitor
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $usuario_actual=Auth::user();



        return $next($request);

    }
}
