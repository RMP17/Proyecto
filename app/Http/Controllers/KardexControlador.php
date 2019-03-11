<?php

namespace Allison\Http\Controllers;

use Allison\Http\Requests\KardexRequest;
use Allison\Kardex;

class KardexControlador extends Controller
{
	 public function getKardesEmpleado($id_empleado)
	{
        $kardex = Kardex::getKardexEmpleado($id_empleado);
        return response()->json($kardex);
	}
	public function store(KardexRequest $request)
	{
        Kardex::newKardex($request->all());
        return response()->json();
	}
	public function update(KardexRequest $request,$id_kardex)
	{
        Kardex::updateKardex($request->all());
        return response()->json();
	}
}
