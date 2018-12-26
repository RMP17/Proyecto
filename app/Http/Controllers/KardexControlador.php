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
	public function index(Request $peticion)
	{
		if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$kardex = DB::table('kardex as k')
				->join('empleado as e', 'k.id_empleado', '=', 'e.id_empleado')
				->join('cargo as c', 'k.id_cargo', '=', 'c.id_cargo')
				->join('tipo_empleado as t', 'k.id_tipo_empleado', '=', 't.id_tipo_empleado')
				->join('salario as s', 'k.id_kardex', '=', 's.id_kardex')

				->select('k.id_kardex','k.fecha_inicio as fecha_inicio','k.fecha_baja as fecha_baja','k.fecha_registro as fecha_registro','e.id_empleado','e.nombre as nombre_empleado','c.id_cargo','c.nombre as nombre_cargo','t.id_tipo_empleado','t.tipo as tipo', 's.id_kardex','s.monto as monto')
				->get();
			return view('kardex.index', compact('kardex', 'consulta'));
		}
	}
	 public function create()
	{
		$empleados = Empleado ::orderBy('nombre', 'asc')
			->get();
		$cargos = Cargo ::orderBy('nombre','asc')
			->get();
		$tipo_empleado = TipoEmpleado ::orderBy('tipo','asc')
			->get();
		$monedas = Moneda ::orderBy('nombre','asc')
			->get();
		return view('kardex.create', compact('empleados', 'cargos','tipo_empleado','monedas'));
	
	}
	public function store(KardexPeticion $peticion)
	{

		$kardexActiva = Kardex ::where('id_empleado', '=', $peticion -> get('cbxEmpleado'))
			->where('fecha_baja', '=', null)
			->get();
		if(sizeof($kardexActiva) == 0)
		{

		$kardex = new Kardex;
		$kardex -> fecha_inicio = date("Y-m-d", strtotime($peticion -> get('dtmFecha_inicio')));
		$kardex -> fecha_registro= date("Y-m-d", time());
		$kardex -> id_empleado= $peticion -> get('cbxEmpleado');
		$kardex -> id_cargo= $peticion -> get('cbxCargo');
		$kardex -> id_tipo_empleado= $peticion -> get('cbxTipo_empleado');
		$kardex->save();

		$id_kardex = Kardex ::where('id_empleado', '=', $peticion -> get('cbxEmpleado'))
				->where('kardex.fecha_baja','=', null)
				->first()
				->id_kardex;
		$salarios = new Salario;
		$salarios-> id_kardex = $id_kardex;
		$salarios -> monto = $peticion -> get('txtMonto');
		$salarios -> id_moneda = $peticion -> get('cbxMoneda');
		$salarios -> save();
	}

		return Redirect :: to ('kardex');
	}
	public function edit($id_kardex)
	{
		$empleados = Empleado ::orderBy('nombre', 'asc')
			->get();
		$cargos = Cargo ::orderBy('nombre','asc')
			->get();
		$tipo_empleado = TipoEmpleado ::orderBy('tipo','asc')
			->get();
		$monedas= Moneda ::orderBy('nombre', 'asc')->get();
		$kardex = Kardex :: findOrFail($id_kardex);
		$salario = Salario :: findOrFail($id_kardex);
		return view ('kardex.edit',compact('kardex','salario','empleados', 'cargos','tipo_empleado','monedas'));
	}
	
	public function update(KardexPeticion $peticion, $id_kardex)
	{
		$kardex = Kardex :: findOrFail($id_kardex);
		$kardex -> id_empleado= $peticion -> get('cbxEmpleado');
		$kardex -> id_cargo= $peticion -> get('cbxCargo');
		$kardex -> id_tipo_empleado= $peticion -> get('cbxTipo_empleado');
		$kardex->update();

		$id_kardex = Kardex ::where('id_empleado', '=', $peticion -> get('cbxEmpleado'))
				->where('kardex.fecha_baja','=', null)
				->first()
				->id_kardex;
		$salarios = Salario :: findOrFail($id_kardex);
		$salarios -> monto = $peticion -> get('txtMonto');
		$salarios -> id_moneda = $peticion -> get('cbxMoneda');
		$salarios -> update();
	     
		return Redirect :: to ('kardex');
	}
	public function destroy($id_kardex)
	{
		$kardexBaja = Kardex :: findOrFail($id_kardex)
			->where('fecha_baja', '=', null)
			->get();
		if(sizeof($kardexBaja) == 0)
		{
		$kardex = Kardex :: findOrFail($id_kardex);
		$kardex->fecha_baja = date("Y-m-d", time());;
		$kardex->update();
	     }
		return Redirect :: to ('kardex');
	 }
	
   
}
