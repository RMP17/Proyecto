<?php

namespace Allison\Http\Controllers;

use Allison\CompraCredito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Allison\Compra;

class CompraCreditoController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'monto' => 'required|numeric|min:1',
            'tipo_pago' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $_compra= Compra::find($request['id_compra']);
        $compra_credito_total= CompraCredito::where('id_compra',$request['id_compra'])->sum('monto');
        if($compra_credito_total>=$_compra->costo_total) {
            return response()->json( ['credito' => ['Este crédito esta cancelado']],400);
        }
        $compraCredito = CompraCredito::newCompraCredito($request->all());
        return response()->json();
    }
    public function getCreditoCompra($id_compra){
        return response()->json(CompraCredito::getCreditoCompra($id_compra));
    }
}
