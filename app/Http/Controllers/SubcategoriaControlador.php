<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\SubcategoriaPeticion;
use Allison\Categoria;
use Allison\Subcategoria;
use DB;

class SubcategoriaControlador extends Controller
{
     public function __construct()
	{
		
	}
	
	public function show(Request $peticion, $id_categoria){
		if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$subcategorias = Subcategoria ::where('subcategoria', 'like','%'.$consulta.'%')
				->where('id_categoria', '=', $id_categoria)
				->orderBy('subcategoria','asc')
				->paginate(10);
			return view('categoria.subcategoria.show', compact('subcategorias', 'consulta', 'id_categoria'));
		}
	}
	
	public function create($id_categoria)
	{
		return view('categoria.subcategoria.create', compact('id_categoria'));
	}
	
	public function store(SubcategoriaPeticion $peticion)
	{
		$subcategoria = new Subcategoria;
		$subcategoria -> subcategoria = $peticion -> get('txtSubcategoria');
		$subcategoria -> descripcion = $peticion -> get('txtDescripcion');
		$subcategoria -> id_categoria = $peticion -> get('txtIdCategoria');
		$subcategoria -> save();
		$id_categoria=$peticion -> get('txtIdCategoria');
		return Redirect :: to ('subcategoria/'.$id_categoria);
	}
	
	public function edit($id_subcategoria)
	{
		return view ('categoria.subcategoria.edit', ['subcategoria' => Categoria :: findOrFail($id_subcategoria)]);
	}
	
	public function update(SubcategoriaPeticion $peticion, $id_subcategoria)
	{
		$subcategoria = Subcategoria :: findOrFail($id_subcategoria);
		$subcategoria -> subcategoria = $peticion -> get('txtSubcategoria');
		$subcategoria -> descripcion = $peticion -> get('txtDescripcion');
		$subcategoria->update();
		$id_categoria=$peticion -> get('txtIdCategoria');
		return Redirect :: to ('subcategoria/'.$id_categoria);
	}
	public function destroy($id_subcategoria)
	{
		$peticion= new SubcategoriaPeticion;
		$subcategoria = Subcategoria :: findOrFail($id_subcategoria);
		DB::table('subcategoria')->where('id_subcategoria', '=', $id_subcategoria)->delete();
		/*$id_categoria=$peticion -> get('txtIdCategoria');*/
		return Redirect :: to ('categoria');
	}
	
	public function SubcategoriasPorCategoria(Request $peticion, $id_categoria)
	{
		if($peticion->ajax())
		{
			$subcategorias = Subcategoria::where('id_categoria', '=', $id_categoria)
				->get();
			return response()->json($subcategorias);
		}
	}
}
