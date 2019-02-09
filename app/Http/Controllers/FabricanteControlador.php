<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\FabricantePeticion;
use Allison\Fabricante;
use DB;
use Allison\Bitacora;



class FabricanteControlador extends Controller
{
    public function index()
	{
        $fabricantes = Fabricante::orderBy('nombre','asc')->paginate(10);

        $response =[
            'pagination'=>[
                'total'=> $fabricantes->total(),
                'per_page'=> $fabricantes->perPage(),
                'current_page'=> $fabricantes->currentPage(),
                'last_page'=> $fabricantes->lastPage(),
                'from'=> $fabricantes->firstItem(),
                'to'=> $fabricantes->lastItem(),
            ],
            'data'=>$fabricantes->Items()
        ];
        return response()->json($response);
	}
	
	public function create()
	{
		return view('fabricante.create');
	}
	
	public function store(FabricantePeticion $peticion)
	{
		$fabricante = new Fabricante;
		$fabricante-> nombre= $peticion -> get('nombre');
		$fabricante-> contacto= $peticion -> get('contacto');
		$fabricante-> sitio_web= $peticion -> get('sitio_web');
		$fabricante -> save();
		return response()->json($fabricante);
	}
	
	public function show($id_fabricante)
	{
		return view ('fabricante.show', ['fabricante' => Fabricante :: findOrFail($id_fabricante)]);
	}
	
	public function edit($id_fabricante)
	{
		return view ('fabricante.edit', ['fabricante' => Fabricante :: findOrFail($id_fabricante)]);
	}
	
	public function update(FabricantePeticion $peticion, $id_fabricante)
	{
		$fabricante = Fabricante :: findOrFail($id_fabricante);
        Bitacora::insertInBitacora('UPDATE', $fabricante);
		$fabricante -> nombre = $peticion -> get('nombre');
		$fabricante-> contacto= $peticion -> get('contacto');
		$fabricante-> sitio_web= $peticion -> get('sitio_web');
		$fabricante->update();
		return response()->json();
	}
	
	public function destroy($id_fabricante)
	{
		$fabricante = Fabricante :: findOrFail($id_fabricante);
        Bitacora::insertInBitacora('DELETE', $fabricante);
        $fabricante->delete();
		return response()->json();
	}
    public function getAllFabricantes(){
        return response()->json(Fabricante::orderBy('nombre','asc')->get());
    }
}
