<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\TipoEmpleadoPeticion;
use Allison\TipoEmpleado;
use DB;

class TipoEmpleadoControlador extends Controller
{
     public function __construct()
	{
		
	}
	
	public function index(Request $peticion)
	{
		if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$tipo_empleados = TipoEmpleado::where('tipo', 'like','%'.$consulta.'%')
				->orderBy('tipo','asc')
				->paginate(10);
			return view('empleado.tipoempleado.index', compact('tipo_empleados', 'consulta'));
		}
	}
	
	public function create()
	{
		return view('empleado.tipoempleado.create');
	}
	
	public function store(TipoEmpleadoPeticion $peticion)
	{
		$tipo_empleado = new TipoEmpleado;
		$tipo_empleado -> tipo = $peticion -> get('txtTipo');
		$tipo_empleado -> save();
		return Redirect :: to ('tipoempleado');
	}
	
	public function show($id_tipo_empleado)
	{
		return view ('empleado.tipoempleado.show', ['tipo_empleado' => TipoEmpleado :: findOrFail($id_tipo_empleado)]);
	}
	
	public function edit($id_tipo_empleado)
	{
		return view ('empleado.tipoempleado.editar', ['tipo_empleado' => TipoEmpleado :: findOrFail($id_tipo_empleado)]);
	}
	
	public function update(tipoempleadoPeticion $peticion, $id_tipo_empleado)
	{
		$tipo_empleado = TipoEmpleado :: findOrFail($id_tipo_empleado);
		$tipo_empleado -> tipo = $peticion -> get('txtTipo');
		$tipo_empleado->update();
		return Redirect :: to ('tipoempleado');
	}
	
	public function destroy($id_tipo_empleado)
	{
		$tipo_empleado = TipoEmpleado :: findOrFail($id_tipo_empleado);
		DB::table('tipo_empleado')->where('id_tipo_empleado', '=', $id_tipo_empleado)->delete();
		return Redirect :: to ('tipoempleado');
	}

}
