<?php

namespace Allison\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class PermisoCaja
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
        $id_acceso=auth()->user()->id_empleado;
        $existsPermission = DB::table('permiso_usuario')->where('id_acceso',$id_acceso)->where('id_permiso',17)->first();

        if(is_null($existsPermission)){
            return back();
        }

        return $next($request);
    }
}
