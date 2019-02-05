<?php

namespace Allison\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\CajaChicaPeticion;
use Allison\CajaChica;
use Allison\Sucursal;
use Allison\Empleado;
use DB;
use Carbon\Carbon;

class CajaChicaControlador extends Controller
{
   
   public function index()
	{

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
	public function getCajaChicaByRangeDate(Request $request)
	{
        $dates = ['date_start' => $request['date1'], 'date_end'=> $request['date2']];
        $validator = validator()->make($dates, [
            'date_start' => ['required', 'date_format:Y-m-d'],
            'date_end' => ['required', 'date_format:Y-m-d'],
        ]);
        $d1 = Carbon::parse($dates['date_start']);
        $d2 = Carbon::parse($dates['date_end']);
        if ($d1 > $d2) {
            return response()->json(['errors' => 'Fecha de inicio debe ser menor o igual a la fecha final'],400);
        }
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $cajasChicas = CajaChica::getCajaChicaByRangeDate($dates['date_start'], $dates['date_end']);
		return response()->json($cajasChicas);
	}
}

