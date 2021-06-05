<?php

namespace App\Http\Middleware;

use Closure;
use \Auth;
class admin
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

        if($usuario_actual->role_id!=1){
            return response()->view('errors.notAuthorized');
        }
        return $next($request);
    }
}
