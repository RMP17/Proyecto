<?php

namespace Allison\Http\Controllers;
use Allison\Http\Controllers\ConversorImagenes;
use Allison\Http\Requests\VentaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
/*use Illuminate\Support\Facades\Validator;*/
use Allison\Venta;
use Allison\DetalleVenta;
use Allison\Articulo;
use Allison\Cliente;
use Allison\Caja;
use Carbon\Carbon;

class VentaControlador extends Controller
{
    public function __construct()
	{
        $this->middleware('permiso_venta', ['only' => ['index']]);
	}
	
	public function index()
	{
        return view('venta.index');
	}
	
	public function create()
	{
		$paises = Pais::orderBy('nombre', 'asc')
			->get();
		return view('venta.create', compact('paises'));
	}
	
	public function store(VentaRequest $request)
	{
		$venta = Venta::newVenta($request->all());
		if ($venta['code']!==200){
		    return response()->json($venta['message'], $venta['code']);
        } else{
            return response()->json($venta['data']);
        }
	}
	
	public function show($id_empleado)
	{
		return view ('venta.show', ['venta' => Empleado :: findOrFail($id_empleado)]);
	}
	
	public function destroy($id_empleado)
	{
		$venta = Empleado :: findOrFail($id_empleado);
		$venta->estatus = 'X';
		$venta->update();
		return Redirect :: to ('venta');
	}

	public function getVentasByRageDate(Request $request)
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
        $ventas = Venta::getVentasByRageDate($dates['date_start'], $dates['date_end']);
        return response()->json($ventas);
	}
	public function getVentasById($id_venta)
	{
        $ventas = Venta::getVentaById($id_venta);
        return response()->json($ventas);
	}
	public function getSalesOnCreditInForce()
	{
        $ventas = Venta::getSalesOnCreditInForce();
        return response()->json($ventas);
	}
	public function cancelSale($id_venta)
	{
        Venta::cancelSale($id_venta);
        return response()->json();
	}
}
