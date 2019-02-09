<?php

namespace Allison\Http\Middleware;

use Allison\Acceso;
use Closure;
use Illuminate\Support\Facades\DB;

class PermisoPanelAdm
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
        $existsPermission = DB::table('permiso_usuario')->where('id_acceso',$id_acceso)->where('id_permiso',13)->first();

        if(is_null($existsPermission) && auth()->user()->usuario!='admin'){
            return back();
        }

        return $next($request);
    }
}
