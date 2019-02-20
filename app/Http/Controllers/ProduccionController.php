<?php

namespace Allison\Http\Controllers;

use Allison\Almacen;
use Allison\Http\Requests\ProduccionRequest;
use Allison\Produccion;
use Allison\ProduccionCredito;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProduccionController extends Controller
{
    public function index(){

        $outputData=[
            'almacenes' => Almacen::getAlmacenes(),
        ];
        return view('produccion.index',$outputData);
    }
    public function store(ProduccionRequest $request){

        $produccion = Produccion::newProduccion($request->all());
        if ($produccion['code']!==200){
            return response()->json($produccion['message'], $produccion['code']);
        } else{
            return response()->json($produccion['data']);
        }
    }
    public function show($id_produccion){

        $produccion = Produccion::getProduccionById($id_produccion);
        return $produccion->toJson();
//        return response()->json($produccion);
    }
    public function getProduccionesByRangeDate(Request $request)
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
        $producciones = Produccion::getProduccionesByRangeDate($dates['date_start'], $dates['date_end']);
        return response()->json($producciones);
    }
    public function forceGetProductionCredits()
    {
        $producciones = Produccion::forceGetProductionCredits();
        return response()->json($producciones);
    }
    public function getCreditoOfProduccion($id_produccion){
        $_produccion= ProduccionCredito::getCreditoOfProduccion($id_produccion);
        return $_produccion;
    }
}
