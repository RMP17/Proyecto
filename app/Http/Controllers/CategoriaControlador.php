<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\CategoriaPeticion;
use Allison\Categoria;
use Allison\Bitacora;

class CategoriaControlador extends Controller
{
    public function __construct()
	{
		
	}
	
	public function index(){
        $categorias = Categoria::orderBy('categoria','asc')->paginate(10);

        $response =[
            'pagination'=>[
                'total'=> $categorias->total(),
                'per_page'=> $categorias->perPage(),
                'current_page'=> $categorias->currentPage(),
                'last_page'=> $categorias->lastPage(),
                'from'=> $categorias->firstItem(),
                'to'=> $categorias->lastItem(),
            ],
            'data'=>$categorias->Items()
        ];
        return response()->json($response);
	}
	
	public function create()
	{
		return view('categoria.create');
	}
	
	public function store(CategoriaPeticion $peticion)
	{
		$categoria = new Categoria;
		$categoria -> categoria = $peticion -> get('categoria');
		$categoria -> descripcion = $peticion -> get ('descripcion');
		$categoria -> save();
		return response()->json($categoria);
	}
	
	public function show($id_categoria)
	{
		return view ('categoria.show', ['categoria' => Categoria :: findOrFail($id_categoria)]);
	}
	
	public function edit($id_categoria)
	{
		return view ('categoria.edit', ['peticion' => Categoria :: findOrFail($id_categoria)]);
	}
	
	public function update(CategoriaPeticion $peticion, $id_categoria)
	{
		$categoria = Categoria :: findOrFail($id_categoria);
        Bitacora::insertInBitacora('UPDATE', $categoria);
		$categoria -> categoria = $peticion -> get('categoria');
		$categoria -> descripcion = $peticion -> get ('descripcion');
		$categoria -> update();
		return response()->json();
	}
	
	public function destroy($id_categoria)
	{
		$categoria = Categoria::findOrFail($id_categoria);
        Bitacora::insertInBitacora('DELETE', $categoria);
		$categoria->delete();
		return response()->json();
	}
    public function getAllCategorias(){
        return response()->json(Categoria::orderBy('categoria','asc')->get());
    }

}
