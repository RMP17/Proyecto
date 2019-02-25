<?php

namespace Allison\Http\Controllers;

use Allison\Almacen;
use Allison\Http\Requests\ProduccionEntregaRequest;
use Allison\Http\Requests\ProduccionRequest;
use Allison\Produccion;
use Allison\ProduccionCredito;
use Allison\ProduccionEntrega;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ProduccionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permiso_produccion', ['only' => ['index']]);
    }
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
        return response()->json($produccion);
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
    public function payCredit(Request $request){
        $validator = Validator::make($request->all(), [
            'monto' => 'required|numeric|min:1',
            'id_produccion' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $_produccion= Produccion::find($request['id_produccion']);
        $produccion_credito_total= ProduccionCredito::where('id_produccion',$request['id_produccion'])->sum('monto');
        if($produccion_credito_total>=$_produccion->costo_total) {
            return response()->json( ['credito' => ['Este crédito esta cancelado']],400);
        }
        Produccion::payCredit($request->all());
        return response()->json();
    }
    public function storeProduccionEntrega(ProduccionEntregaRequest $request){

        Produccion::newProduccionEntrega($request->all());
        return response()->json();
    }
    public function getEntregasByProduccion($id_produccion){

        $entregasByProduccion=Produccion::getEntregasByProduccion($id_produccion);
        return response()->json($entregasByProduccion);
    }
}
