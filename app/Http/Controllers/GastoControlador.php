<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\GastoPeticion;
use Allison\Gasto;
use Carbon\Carbon;

class GastoControlador extends Controller
{
    public function show(Request $peticion, $id_caja_chica)
    {
        if ($peticion) {
            $gastos = Gasto::where('id_caja_chica', '=', $id_caja_chica)
                ->paginate(10);
            return view('cajachica.gasto.show', compact('gastos', 'id_caja_chica'));
        }
    }
    public function create($id_caja_chica)
    {
        return view('cajachica.gasto.create', compact('id_caja_chica'));
    }

    public function store(GastoPeticion $peticion)
    {
        $gasto = Gasto::newGasto($peticion->all());
        if ($gasto['code'] != 200) {
            return response()->json($gasto['messages'], $gasto['code']);
        }
        return response()->json();
    }
    public function getGastoByRangeDate(Request $request)
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
        $gastos = Gasto::getGastoByRangeDate($dates['date_start'], $dates['date_end']);
        return response()->json($gastos);
    }
}
