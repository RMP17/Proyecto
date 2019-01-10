<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\KardexPeticion;
use Allison\Kardex;
use Allison\Empleado;
use Allison\Cargo;
use Allison\TipoEmpleado;
use Allison\Salario;
use Allison\Moneda;
use DB;

class KardexControlador extends Controller
{
	 public function getKardesEmpleado($id_empleado)
	{
        $kardex = Kardex::getKardexEmpleado($id_empleado);
        return response()->json($kardex);
	}
}
