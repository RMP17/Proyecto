<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\input;
use Allison\Http\Requests\CompraPeticion;
use Illuminate\Support\Facades\Validator;
use Allison\Articulo;
use Allison\Compra;
use Allison\Moneda;
use Allison\Empleado;
use Allison\Contacto;
use Carbon\Carbon;
use Allison\Proveedor;
use Allison\Sucursal;
use Allison\DetalleCompra;
use Allison\TipoPago;

class CompraControlador extends Controller
{

    public function __construct()
    {
        $this->middleware('permiso_compra', ['only' => ['index']]);
    }

    public function index()
    {
        return view('compra.index');
    }

    public function create(Request $peticion)
    {
        $articulos = DB::table('articulo as art')
            ->orderBy('art.nombre', 'asc')
            ->where('art.estatus', '=', 'A')
            ->get();
        $sucursales = Sucursal::orderBy('nombre', 'asc')
            ->get();
        $contactos = Contacto::orderBy('nombre', 'asc')
            ->get();
        $tipo_pagos = TipoPago::orderBy('tipo_pago', 'asc')
            ->get();
        $Monedas = Moneda::orderBy('nombre', 'asc')
            ->get();
        return view('compra.create', compact('articulos', 'sucursales', 'contactos', 'tipo_pagos', 'contactos'));
    }

    public function store(CompraPeticion $peticion)
    {
        Compra::newCompra($peticion->all());
        return response()->json();
    }

    public function articulo(CompraPeticion $peticion)
    {
        $id_articulo = $peticion->get('id_articulo');

        $articulos = Articulo:: findOrFail($id_articulo);
        return view('compra.articulo', compact('articulos'));
    }
    public function getComprasByRageDate(Request $request)
    {
        $dates = ['date_start' => $request['date1'], 'date_end'=> $request['date2']];
        $validator = Validator::make($dates, [
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
        $compras = Compra::getComprasByRageDate($dates['date_start'], $dates['date_end']);
        return response()->json($compras);
    }
    public function getPurchasesOnCreditInForce()
    {
        $compras = Compra::getPurchasesOnCreditInForce();
        return response()->json($compras);
    }
    public function purchaseArrived($id_compra)
    {
        Compra::purchaseArrived($id_compra);
        return response()->json();
    }
}

