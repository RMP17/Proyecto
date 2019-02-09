<?php

namespace Allison\Http\Middleware;

use Closure;

class CheckStatus
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
        $response = $next($request);
        //If the status is not approved redirect to login
        if(auth()->check() && auth()->user()->estatus == 0){
            auth()->logout();
            return redirect('/login')->with('error_login', 'Tu cuenta de usuario fue dada de baja');
        }
        return $response;
    }
}
