<?php

namespace Allison\Http\Controllers;
use Allison\Http\Controllers\ConversorImagenes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\PrecioPeticion;
use Allison\Articulo;
use Allison\Precio;
use Allison\Sucursal;
use DB;

class PrecioControlador extends Controller
{
    public function __construct()
	{
		
	}
	
	public function index(Request $peticion)
	{	
		if ($peticion)
		{
			$precios = DB::table('precio')
				->join('sucursal', 'precio.id_sucursal', '=', 'sucursal.id_sucursal')
				->join('articulo', 'precio.id_articulo', '=', 'articulo.id_articulo')
				->orderBy('sucursal.id_sucursal', 'asc')
				->orderBy('articulo.nombre', 'asc')
				->select('precio.id_precio as id_precio', 
							'precio.precio_1 as precio_1',
							'precio.precio_2 as precio_2', 
							'precio.precio_3 as precio_3', 
							'precio.precio_4 as precio_4', 
							'precio.precio_5 as precio_5', 
							'precio.id_articulo as id_articulo', 
							'precio.id_sucursal as id_sucursal', 
							'sucursal.nombre as sucursal', 
							'articulo.nombre as articulo')
				->get();
				$sucursales = Sucursal::orderBy('nombre', 'asc')
					->get();
				$articulos = Articulo::orderBy('nombre', 'asc')
					->get();
			return view('articulo.precio.index', compact('precios', 'sucursales', 'articulos'));
		}
	}
	
	public function create()
	{
		return view('articulo.precio.create');
	}
	
	public function store(PrecioPeticion $peticion)
	{
		$precio = new Precio;
		$precio -> precio_1 = $peticion -> get('txtPrecio1');
		$precio -> precio_2 = $peticion -> get('txtPrecio2');
		$precio -> precio_3 = $peticion -> get('txtPrecio3');
		$precio -> precio_4 = $peticion -> get('txtPrecio4');
		$precio -> precio_5 = $peticion -> get('txtPrecio5');
		$precio -> id_articulo = $peticion -> get('cbxArticulo');
		$precio -> id_sucursal = $peticion -> get('cbxSucursal');
		$precio -> save();
		return Redirect :: to ('precio');
	}
	
	public function show($id_precio)
	{
		return view ('articulo.precio.show', ['precio' => Precio :: findOrFail($id_precio)]);
	}
	
	public function edit($id_precio)
	{
		return view ('articulo.precio.edit', ['precio' => Precio :: findOrFail($id_precio)]);
	}
	
	public function update(PrecioPeticion $peticion, $id_precio)
	{
		$precio = Precio :: findOrFail($id_precio);
		$precio -> precio_1 = $peticion -> get('txtPrecio1');
		$precio -> precio_2 = $peticion -> get('txtPrecio2');
		$precio -> precio_3 = $peticion -> get('txtPrecio3');
		$precio -> precio_4 = $peticion -> get('txtPrecio4');
		$precio -> precio_5 = $peticion -> get('txtPrecio5');
		$precio->update();
		return Redirect :: to ('precio');
	}
	
	public function destroy($id_precio)
	{
		$precio = Precio :: findOrFail($id_precio);
		DB::table('precio')->where('id_precio', '=', $id_precio)->delete();
		return Redirect :: to ('precio');
	}
}
