<?php

namespace Allison\Http\Controllers;
use Allison\Http\Controllers\ConversorImagenes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\AlmacenPeticion;
use Allison\Almacen;
use Allison\Sucursal;
use DB;

class AlmacenControlador extends Controller
{
    public function index()
	{
        return response()->json(Almacen::getAlmacenes());
	}

	public function create($id_sucursal)
	{
		return view('sucursal.almacen.create', compact('id_sucursal'));
	}
	
	public function store(AlmacenPeticion $peticion)
	{
		Almacen::addAlmacen($peticion->all());
		return response()->json();
	}
	
	public function edit($id_almacen)
	{
		return view ('sucursal.edit', ['almacen' => Almacen :: findOrFail($id_almacen)]);
	}
	
	public function update(AlmacenPeticion $peticion, $id_almacen)
	{
		Almacen::updateAlmacen($peticion->all(), $id_almacen);
		return response()->json();
	}
	
	public function destroy($id_almacen)
	{
		$almacen= Almacen :: findOrFail($id_almacen);
		DB::table('almacen')->where('id_almacen', '=', $id_almacen)->delete();
		/*$id_pais=$peticion -> get('txtIdPais');*/
		return Redirect :: to ('empresa');
	}
	
	public function AlmacenesPorSucursal(Request $peticion, $id_sucursal)
	{
		if($peticion->ajax())
		{
			$almacenes = Almacen::where('id_sucursal', '=', $id_sucursal)
				->get();
			return response()->json($almacenes);
		}
	}
}
