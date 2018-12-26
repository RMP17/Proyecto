<?php

namespace Allison\Http\Controllers;
use Allison\Http\Controllers\ConversorImagenes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\ArticuloPeticion;
use Allison\Articulo;
use Allison\Categoria;
use Allison\Subcategoria;
use Allison\Fabricante;
use Allison\Dimensiones;
use Allison\Pieza;
use DB;

class ArticuloControlador extends Controller
{
    public function __construct()
	{
		
	}
	
	public function index()
	{	
		/*if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$articulos = DB::table('articulo')
				->join('subcategoria', 'articulo.id_subcategoria', '=', 'subcategoria.id_subcategoria')
				->join('fabricante', 'articulo.id_fabricante', '=', 'fabricante.id_fabricante')
				->where('articulo.nombre', 'like', '%'.$consulta.'%')
				->orderBy('nombre', 'asc')
				->select('articulo.id_articulo as id_articulo',
							'articulo.nombre as nombre',
							'articulo.codigo as codigo',
							'articulo.codigo_barra as codigo_barra',
							'articulo.caracteristicas as caracteristicas',
							'articulo.precio_compra as precio_compra',
							'articulo.precio_produccion as precio_produccion',
							'articulo.estatus as estatus',
							'articulo.imagen as imagen',
							'articulo.fecha_registro as fecha_registro',
							'articulo.divisible as divisible',
							'articulo.id_subcategoria as id_subcategoria',
							'articulo.id_fabricante as id_fabricante',
							'subcategoria.subcategoria as subcategoria',
							'fabricante.nombre as fabricante'
							)
				->get();

		}*/
        return view('articulo.index');
	}
	
	public function create()
	{
		$categorias = Categoria::orderBy('categoria', 'asc')
			->get();
		$fabricantes = Fabricante::orderBy('nombre','asc')
			->get();
		return view('articulo.create', compact('categorias', 'fabricantes'));
	}
	
	public function store(ArticuloPeticion $peticion)
	{
		$conversor = new ConversorImagenes;
		$articulo = new Articulo;
		$articulo -> nombre = $peticion -> get('txtNombre');
		$articulo -> codigo = $peticion -> get('txtCodigo');
		$articulo -> codigo_barra = $peticion -> get('txtCodigoBarra');
		$articulo -> caracteristicas = $peticion -> get('txtCaracteristicas');
		$articulo -> precio_compra = $peticion -> get('txtPrecioCompra');
		$articulo -> precio_produccion = $peticion -> get('txtPrecioProduccion');
		$articulo -> estatus = 'A';
		$articulo -> imagen = $conversor->ImagenABinario($peticion -> get('imgImagen'));
		$articulo -> fecha_registro = date('Y-m-d', time());
		$articulo -> divisible = $peticion -> get('rbtDivisible');
		$articulo -> id_subcategoria = $peticion -> get('cbxSubcategoria');
		$articulo -> id_fabricante= $peticion -> get('cbxFabricante');
		$articulo -> save();
		if ($peticion -> get('rbtDimensionable'))
		{
			$id_articulo = Articulo::where('codigo', '=', $peticion -> get('txtCodigo'))
				->first()
				->id_articulo;
			$dimensiones = new Dimensiones;
			$dimensiones -> id_articulo = $id_articulo;
			$dimensiones -> largo = $peticion -> get('txtLargo');
			$dimensiones -> ancho = $peticion -> get('txtAncho');
			$dimensiones -> espesor = $peticion -> get('txtEspesor');
			$dimensiones -> volumen = $peticion -> get('txtVolumen');
			$dimensiones -> save();
		}
		return Redirect :: to ('articulo');
	}
	
	public function show($id_articulo)
	{
		return view ('articulo.show', ['articulo' => Articulo :: findOrFail($id_articulo)]);
	}
	
	public function edit($id_articulo)
	{
		$categorias = Categoria::orderBy('categoria', 'asc')
			->get();
		$subcategorias = Subcategoria::orderBy('subcategoria','asc')
			->get();
		$fabricantes = Fabricante::orderBy('nombre', 'asc')
			->get();
		$articulo = Articulo :: findOrFail($id_articulo);
		$id_subcategoria = $articulo -> id_subcategoria;
		$categoria = Categoria::join('subcategoria', 'categoria.id_categoria', '=', 'subcategoria.id_categoria')
			->where('subcategoria.id_subcategoria', '=', $id_subcategoria)
			->select('categoria.id_categoria as id_categoria', 'categoria.categoria as categoria')
			->first();
		$subcategoria = "";
		foreach($subcategorias as $s) { if($s->id_subcategoria == $id_subcategoria) { $subcategoria = $s->subcategoria; break; } }
		$fabricante = Fabricante::where('id_fabricante', '=', $articulo->id_fabricante)
			->first()
			->nombre;
		$dimensiones = Dimensiones::where('id_articulo', '=', $id_articulo)
			->first();
		return view ('articulo.edit', compact ('articulo', 'categorias', 'subcategorias', 'fabricantes', 'categoria', 'subcategoria', 'fabricante', 'dimensiones'));
	}
	
	public function update(ArticuloPeticion $peticion, $id_articulo)
	{
		$conversor = new ConversorImagenes;
		$articulo = Articulo :: findOrFail($id_articulo);
		$articulo -> nombre = $peticion -> get('txtNombre');
		$articulo -> codigo = $peticion -> get('txtCodigo');
		$articulo -> codigo_barra = $peticion -> get('txtCodigoBarra');
		$articulo -> caracteristicas = $peticion -> get('txtCaracteristicas');
		$articulo -> precio_compra = $peticion -> get('txtPrecioCompra');
		$articulo -> precio_produccion = $peticion -> get('txtPrecioProduccion');
		if ($peticion -> get('imgImagen') != null)
			$articulo -> imagen = $conversor->ImagenABinario($peticion -> get('imgImagen'));
		$articulo -> divisible = $peticion -> get('rbtDivisible');
		$articulo -> id_subcategoria = $peticion -> get('cbxSubcategoria');
		$articulo -> id_fabricante= $peticion -> get('cbxFabricante');
		$articulo->update();
		if ($peticion -> get('rbtDimensionable'))
		{
			$id_articulo = Articulo::where('codigo', '=', $peticion -> get('txtCodigo'))
				->first()
				->id_articulo;
			$dimensiones = Dimensiones::findOrFail($id_articulo);
			$dimensiones -> largo = $peticion -> get('txtLargo');
			$dimensiones -> ancho = $peticion -> get('txtAncho');
			$dimensiones -> espesor = $peticion -> get('txtEspesor');
			$dimensiones -> volumen = $peticion -> get('txtVolumen');
			$dimensiones -> update();
		}
		return Redirect :: to ('articulo');
	}
	
	public function destroy($id_articulo)
	{
		$articulo = Articulo :: findOrFail($id_articulo);
		$articulo->estatus = 'X';
		$articulo->update();
		return Redirect :: to ('articulo');
	}
}
