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
    public function __construct()
	{
		
	}
	
    public function show($id_sucursal)
	{
			$almacenes = DB::table('almacen')
			->join('sucursal', 'almacen.id_sucursal', '=', 'sucursal.id_sucursal')
			->select('almacen.id_almacen as id_almacen', 'almacen.codigo as codigo', 'almacen.direccion as direccion', 'almacen.id_sucursal as id_sucursal', 'sucursal.nombre as sucursal')
			->where('almacen.id_sucursal', '=', $id_sucursal)
			->get();		
			return view('sucursal.almacen.show', compact('almacenes','id_sucursal'));
	}

	public function create($id_sucursal)
	{
		return view('sucursal.almacen.create', compact('id_sucursal'));
	}
	
	public function store(AlmacenPeticion $peticion)
	{
		$almacen = new Almacen;
		$almacen -> codigo = $peticion -> get('txtCodigo');
		$almacen -> direccion = $peticion -> get('txtDireccion');
		$almacen -> id_sucursal = $peticion -> get('txtIdSucursal');
		$almacen -> save();
		$id_sucursal= $peticion -> get('txtIdSucursal');
		return Redirect :: to ('almacen/'.$id_sucursal);
	}
	
	public function edit($id_almacen)
	{
		return view ('sucursal.edit', ['almacen' => Almacen :: findOrFail($id_almacen)]);
	}
	
	public function update(AlmacenPeticion $peticion, $id_almacen)
	{
		$almacen = Almacen :: findOrFail($id_almacen);
		$almacen -> codigo = $peticion -> get('txtCodigo');
		$almacen -> direccion = $peticion -> get('txtDireccion');
		$almacen->update();
		$id_sucursal = $peticion -> get('txtIdSucursal');
		return Redirect :: to ('almacen/'.$id_sucursal);
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
