<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Allison\Permiso;

class PermisoController extends Controller
{
    public function getPermisos(){

        return response()->json(Permiso::getPermisos());
    }
}
