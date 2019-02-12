<?php

namespace Allison\Http\Controllers;

use Allison\Http\Requests\MovimientoAlmacenRequest;
use Allison\MovimientoAlmacen;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MovimientosAlmacenController extends Controller
{
    public function index()
    {
        return view('movimientos_almacen.index');
    }
    public function store(MovimientoAlmacenRequest $request)
    {
        MovimientoAlmacen::newMovimientoAlmacen($request->all());
        return response()->json();
    }
    public function destroy($id_movimiento_almacen)
    {
        MovimientoAlmacen::cancelMovimientoAlmacen($id_movimiento_almacen);
        return response()->json();
    }
    public function getMovimientoAlmacenByRangeDate(Request $request)
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
        $movimientos_almacen = MovimientoAlmacen::getMovimientoAlmacenByRangeDate($dates['date_start'], $dates['date_end']);
        return response()->json($movimientos_almacen);
    }
}
