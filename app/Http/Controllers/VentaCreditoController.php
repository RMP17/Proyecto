<?php

namespace Allison\Http\Controllers;

use Allison\VentaCredito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Allison\Venta;

class VentaCreditoController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'monto' => 'required|numeric|min:1',
            'tipo_pago' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $_venta= Venta::find($request['id_venta']);
        $venta_credito_total= VentaCredito::where('id_venta',$request['id_venta'])->sum('monto');
        if($venta_credito_total>=$_venta->costo_total) {
            return response()->json( ['credito' => ['Este crédito esta cancelado']],400);
        }
        $venteCredito = VentaCredito::newVentaCredito($request->all());
        return response()->json();
    }
    public function getCreditoVenta($id_venta){
        return response()->json(VentaCredito::getCreditoVenta($id_venta));
    }
}
