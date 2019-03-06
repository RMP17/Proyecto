<?php

namespace Allison\Http\Controllers;

use Allison\EntradaSalidaArticulo;
use Allison\Http\Requests\EntradaSalidaArticuloRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EntradaSalidaArticuloController extends Controller
{
    public function store(EntradaSalidaArticuloRequest $request){
        $entrada_salida=EntradaSalidaArticulo::newEntradaSalidaArticulo($request->all());
        if($entrada_salida['code']==200){
            return response()->json();
        } else{
            return response()->json($entrada_salida['message'], $entrada_salida['code']);
        }
    }
    public function getEntradaSalidaByRangeDate(Request $request)
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
        $entradaSalidaArticulo = EntradaSalidaArticulo::getEntradaSalidaByRangeDate($dates['date_start'], $dates['date_end']);
        return response()->json($entradaSalidaArticulo);
    }

}
