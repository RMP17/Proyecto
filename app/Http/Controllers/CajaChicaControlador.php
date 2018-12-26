<?php

namespace Allison\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\CajaChicaPeticion;
use Allison\CajaChica;
use Allison\Sucursal;
use Allison\Empleado;
use DB;

class CajaChicaControlador extends Controller
{
   
   public function index(Request $peticion)
	{
		if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$caja_chica = DB::table('caja_chica as c')
				->join('empleado as e', 'e.id_empleado','=','c.id_empleado')
				->join('sucursal as s', 's.id_sucursal', '=', 'c.id_sucursal')
				->orderBy('c.fecha_cierre', 'asc')
				->select('c.id_caja_chica as id_caja_chica', 
						'c.fecha_apertura as fecha_apertura', 
						'c.fecha_cierre as fecha_cierre', 
						'c.monto_apertura as monto_apertura',
						'c.monto_estado as monto_estado',
						'c.monto_declarado as monto_declarado',
						'c.observaciones as observaciones',
						'c.id_sucursal as id_sucursal',
						'c.id_empleado as id_empleado',
						's.nombre as sucursal',
						'e.nombre as empleado' )
				->get();
			$sucursales = Sucursal::orderBy('nombre', 'asc')
				->get();
			return view('cajachica.index', compact('caja_chica', 'consulta', 'sucursales'));
		}
	}
	
	public function create()
	{
		return view('cajachica.create', compact('sucursales'));
	}
	
	public function store(CajaChicaPeticion $peticion)
	{
		$caja_chica_abierta = CajaChica::where('id_sucursal', '=', $peticion -> get('cbxSucursal'))
			->where('fecha_cierre', '=', null)
			->get();
		if(sizeof($caja_chica_abierta) == 0)
		{
			$caja_chica = new CajaChica;
			$caja_chica -> fecha_apertura= date ('Y-m-d H:i', time());
			$caja_chica -> monto_apertura= $peticion -> get('txtMontoApertura');
			$caja_chica -> monto_estado= $peticion -> get('txtMontoApertura');
			$caja_chica -> id_sucursal= $peticion -> get('cbxSucursal');
			$caja_chica -> id_empleado= $peticion -> get('cbxEmpleado');
			$caja_chica -> save();
			return Redirect :: to ('cajachica');
		}
			return Redirect :: to ('cajachica');
	}
	
	public function edit($id_caja_chica)
	{
		return view ('cajachica.edit',compact('empleados'),['caja_chica' => CajaChica :: findOrFail($id_caja_chica)]);
	}
	
	public function update(CajaChicaPeticion $peticion, $id_caja_chica)
	{
		$caja_chica = CajaChica :: findOrFail($id_caja_chica);
		$caja_chica -> monto_apertura= $peticion -> get('txtMontoApertura');
		$caja_chica -> monto_estado= $peticion -> get('txtMontoApertura');
		$caja_chica -> id_sucursal= $peticion -> get('cbxSucursal');
		$caja_chica -> id_empleado= $peticion -> get('cbxEmpleado');
		$caja_chica->update();
		return Redirect :: to ('cajachica');
	}
	
	public function destroy(CajaChicaPeticion $peticion, $id_caja_chica)
	{
		$caja_chica = CajaChica :: findOrFail($id_caja_chica);
		$caja_chica -> fecha_cierre= date('Y-m-d H:i', time());
		$caja_chica -> monto_declarado = $peticion -> get('txtMontoDeclarado');
		$caja_chica -> observaciones = $peticion -> get('txtObservaciones');
		$caja_chica->update();
		return Redirect :: to ('cajachica');
	}
}

