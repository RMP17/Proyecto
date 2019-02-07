<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\ CajaPeticion;
use Allison\Caja;
use Allison\Empleado;
use Allison\Sucursal;
use Illuminate\Support\Facades\Validator;


class CajaControlador extends Controller
{
    public function __construct()
	{
		
	}
	
	public function index()
	{
        return view('caja.index');
	}
	
	public function create()
	{	$sucursales = Sucursal::orderBy('nombre', 'asc')
				->get();
		return view('caja.create', compact('sucursales'));
	}
	
	public function store(CajaPeticion $peticion)
	{
		Caja::newCaja($peticion->all());
		return response()->json();
	}

	public function update(CajaPeticion $peticion, $id_caja)
	{
        Caja::updateCaja($peticion->all());
        return response()->json();
	}
	
	public function destroy($id_caja)
	{
		$caja = Caja :: findOrFail($id_caja);
		$caja -> estatus = 'X';
		$caja -> update();
		return Redirect :: to ('caja');
	}
	public function getCajas()
	{
	    $cajas = Caja::getCajas();
        return response()->json($cajas);
	}
	public function getCaja()
	{
	    $caja = Caja::getCaja();
	    if(isset($caja['messages'])){
            return response()->json($caja['messages'],$caja['code']);
        }
        return response()->json($caja);
	}
	public function closedAndOpenCashier(Request $request)
	{
        $validator = Validator::make($request->all(), [
            'monto' => 'required|min:0|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
	    $caja=Caja::closedAndOpenCashier($request->all());
        if(!is_null($caja)){
            return response()->json($caja['messages'],$caja['code']);
        }
        return response()->json();
	}
	public function getSummary(Request $request)
	{
        $resumen = Caja::getSummary();
        return response()->json($resumen);
	}
	public function simpleSuggestionsCajas($query)
	{
        $cajas = Caja::simpleSuggestionsCajas($query);
        return response()->json($cajas);
	}
}
