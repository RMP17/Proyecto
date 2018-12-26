<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\ CajaPeticion;
use Allison\Caja;
use Allison\Empleado;
use Allison\Sucursal;
use DB;


class CajaControlador extends Controller
{
    public function __construct()
	{
		
	}
	
	public function index(Request $peticion)
	{
		
		if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$cajas = DB::table('caja')
				->join('empleado', 'caja.id_empleado', '=', 'empleado.id_empleado')
				->join('sucursal', 'caja.id_sucursal', '=', 'sucursal.id_sucursal')
				->where('caja.nombre', 'like', '%'.$consulta.'%')
				->orderBy('caja.id_sucursal', 'asc')
				->select('caja.id_caja as id_caja', 'caja.nombre as nombre',  'caja.id_empleado as id_empleado', 'caja.id_sucursal as id_sucursal', 'empleado.nombre as empleado', 'sucursal.nombre as sucursal')
				->get();
			$sucursales = Sucursal::orderBy('nombre', 'asc')
				->get();
			return view('caja.index', compact('cajas', 'consulta', 'sucursales'));
		}
	}
	
	public function create()
	{	$sucursales = Sucursal::orderBy('nombre', 'asc')
				->get();
		return view('caja.create', compact('sucursales'));
	}
	
	public function store(CajaPeticion $peticion)
	{
		$caja = new Caja;
		$caja -> nombre = $peticion -> get('txtNombre');
		$caja -> estatus = 'A';
		$caja -> id_empleado = $peticion -> get('cbxEmpleado');
		$caja -> id_sucursal = $peticion -> get('cbxSucursal');
		$caja -> save();
		return Redirect :: to ('caja');
	}
	
	public function show($id_caja)
	{
		return view ('caja.show', ['caja' => Caja :: findOrFail($id_caja)]);
	}
	
	public function edit($id_caja)
	{
		return view ('caja.edit', compact ('caja', 'pais'));
	}
	
	public function update(CajaPeticion $peticion, $id_caja)
	{
		$caja = Caja :: findOrFail($id_caja);
		$caja -> nombre = $peticion -> get('txtNombre');
		$caja -> id_empleado = $peticion -> get('cbxEmpleado');
		$caja -> id_sucursal = $peticion -> get('cbxSucursal');
		$caja -> update();
		return Redirect :: to ('caja');
	}
	
	public function destroy($id_caja)
	{
		$caja = Caja :: findOrFail($id_caja);
		$caja -> estatus = 'X';
		$caja -> update();
		return Redirect :: to ('caja');
	}
}
