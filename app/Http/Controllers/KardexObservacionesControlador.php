<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\KardexObservacionesPeticion;
use Allison\KardexObservaciones;

class KardexObservacionesControlador extends Controller
{
    public function __construct()
	{
		
	}
	public function show($id_kardex){

        $kardex_observaciones = KardexObservaciones::getKardexObservacionesOfKardex($id_kardex);
        return response()->json($kardex_observaciones);
	}

	public function store(KardexObservacionesPeticion $peticion)
    {
        KardexObservaciones::newKardexObservacion($peticion->all());
        return response()->json();
	}

	public function update(KardexObservacionesPeticion $peticion, $id_kardex_observacion)
	{
	    KardexObservaciones::updateKardexObservacion($peticion->all(), $id_kardex_observacion);
		return response()->json();
	}
	public function destroy($id_kardex_observacion)
	{
		KardexObservaciones::findOrFail($id_kardex_observacion)->delete();
        return response()->json();
	}
	
}
