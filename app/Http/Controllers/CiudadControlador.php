<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\CiudadPeticion;
use Allison\Ciudad;

class CiudadControlador extends Controller
{
    public function __construct()
	{
		
	}
	
	public function show(Request $peticion, $id_pais){
		if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$ciudades = Ciudad ::where('nombre', 'like','%'.$consulta.'%')
				->where('id_pais', '=', $id_pais)
				->orderBy('nombre','asc')
				->paginate(10);
			return view('pais.ciudad.show', compact('ciudades', 'consulta', 'id_pais'));
		}
	}
	public function create($id_pais)
	{
		return view('pais.ciudad.create', compact('id_pais'));
	}
	
	public function store(CiudadPeticion $peticion)
	{
		$ciudad = new Ciudad;
		$ciudad -> nombre = $peticion -> get('txtNombre');
		$ciudad -> id_pais = $peticion -> get('txtIdPais');
		$ciudad -> save();
		$id_pais=$peticion -> get('txtIdPais');
		return Redirect :: to ('ciudad/'.$id_pais);
	}
	public function edit($id_ciudad)
	{
		return view ('pais.ciudad.edit', ['ciudad' => Ciudad :: findOrFail($id_ciudad)]);
	}
	
	public function update(CiudadPeticion $peticion, $id_ciudad)
	{
		$ciudad = Ciudad :: findOrFail($id_ciudad);
		$ciudad -> nombre = $peticion -> get('txtNombre');
		$ciudad->update();
		$id_pais=$peticion -> get('txtIdPais');
		return Redirect :: to ('ciudad/'.$id_pais);
	}
	public function destroy($id_ciudad)
	{
		//$peticion= new CiudadPeticion;
		$ciudad = Ciudad :: findOrFail($id_ciudad);
		\DB::table('ciudad')->where('id_ciudad', '=', $id_ciudad)->delete();
		//$id_pais=$peticion -> get('txtIdPais');
		return Redirect :: to ('pais');
	}
	
	public function suggestionsOfCiudades($query)
	{
		return response()->json((new Ciudad())->suggestionsOfCiudades($query));
	}
	/*public function getPais()
	{
        return response()->json(Pais::orderBy('pais','asc')->get());
	}*/
}
