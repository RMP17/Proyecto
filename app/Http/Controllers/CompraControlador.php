<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\input;
use Allison\Http\Requests\ArticuloPeticion;
use Allison\Articulo;
use Allison\Moneda;
use Allison\Empleado;
use Allison\Contacto;;
use Allison\Proveedor;
use Allison\Sucursal;
use Allison\DetalleCompra;
use Allison\TipoPago;
use DB;

class CompraControlador extends Controller
{

	public function __construct()
	{	
	}
	public function index(Request $peticion)
	{
		if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$compras = DB::table('compra as c')
			->join('tipo_pago as t', 'c.id_tipo_pago', '=', 't.id_tipo_pago')
			->join('detalle_compra as d', 'c.id_compra','=','d.id_compra')
			->join('almacen as a', 'd.id_almacen', '=', 'a.id_almacen')
			->join('sucursal as s', 'a.id_sucursal', '=', 's.id_sucursal')
			->join('contacto as cont', 'c.id_contacto', '=', 'cont.id_contacto')
			->join('proveedor as p', 'cont.id_proveedor', '=', 'p.id_proveedor')
			/*->join('moneda as m', 'c.id_compra', '=', 'm.id_compra')*/
			->select('c.id_compra as codigo','c.fecha as fecha_compra','c.costo_total as costo_total','t.id_tipo_pago as id_tipo_pago','t.tipo_pago as tipo_pago','s.id_sucursal','s.nombre as nombre_sucursal','a.id_almacen','a.direccion as direccion_almacen', 'cont.id_contacto', 'p.id_proveedor','p.razon_social as razon_social_proveedor')
			->paginate(10);
			return view('compra.index', compact('compras', 'consulta'));
		}

	}
	public function create(Request $peticion)
	{
	     $articulos = DB::table('articulo as art')
	     ->orderBy('art.nombre', 'asc')	
	     ->where('art.estatus','=','A')
	     ->get();
		  $sucursales = Sucursal ::orderBy('nombre', 'asc')
			->get();
		  $contactos = Contacto ::orderBy('nombre', 'asc')
			->get();
		  $tipo_pagos = TipoPago ::orderBy('tipo_pago', 'asc')
			->get();
		  $Monedas = Moneda ::orderBy('nombre', 'asc')
			->get();
		return view('compra.create', compact('articulos','sucursales','contactos','tipo_pagos','contactos'));
	}
	
	public function store(CompraPeticion $peticion)
	{
		try {
			DB:: beginTransaction();	
		$compra = new compra;
		$compra -> fecha = date('Y-m-d', time());
		$compra -> descuento = $peticion -> get('txtDescuento');
		$compra -> costo_total = $peticion -> get('txtCosto_total');
		$compra -> codigo_tarjeta_cheque = $peticion -> get('txtCodigo_tarjeta_cheque');
		$compra -> observaciones = $peticion -> get('txtObservaciones');
		$compra -> estatus = 'P';
		$compra -> id_moneda = $peticion -> get('cbxMoneda');
		$compra -> id_empleado = $peticion -> get('cbxEmpleado');
		$compra -> id_contacto = $peticion -> get('cbxContacto');
		$compra -> id_tipo_pago = $peticion -> get('cbxTipo_pago');
		$compra -> save();

		$id_articulo=$peticion->get('txtId_articulo');
		$id_almacen=$peticion->get('txtId_almacen');
		$cantidad=$peticion ->get('txtCantidad');
		$costo_total=$peticion ->get('txtCosto_total');
		  
		$cont=0;
		while ( $cont< count($id_articulo)) {
			$dettale=new DetalleCompra();
			$detalle-> id_compra=$compra-> id_compra;
			$detalle-> id_articulo= $id_articulo[$cont];
			$detalle-> id_almacen= $id_almacen[$cont];
			$detalle-> cantidad= $cantidad[$cont];
			$detalle-> costo_total= $costo_total[$cont];	
		}

		DB:: commit();
		} catch (\Exception $e) {
			DB::rollback();
			
		}
		return Redirect :: to ('compra');
     }
     public function articulo( CompraPeticion $peticion )
	{
		$id_articulo=$peticion -> get('id_articulo');
		
		$articulos = Articulo :: findOrFail($id_articulo);
		return view ('compra.articulo', compact ('articulos'));
	}
}

