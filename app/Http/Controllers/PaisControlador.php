<?php

namespace Allison\Http\Controllers;

use Allison\Ciudad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\PaisPeticion;
use Allison\Pais;
use Illuminate\Support\Facades\Validator;


class PaisControlador extends Controller
{
    public function __construct()
	{
		
	}
	
	public function index()
	{
        $paises = Pais::all();
        if(count($paises)>0) {
            foreach ($paises as $pais){
                $pais->ciudades;
            }
        }
        return response()->json($paises);
	}
	
	public function store(Request $peticion)
	{
        $validator = Validator::make($peticion->all(), [
            'nombre' => 'required|max:50|unique:pais,nombre',
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        };
		$pais = new Pais;
		$pais -> nombre = $peticion -> get('nombre');
		$pais -> save();
		return response()->json();
	}
	
	public function show($id_pais)
	{
		return view ('pais.show', ['pais' => Pais :: findOrFail($id_pais)]);
	}
	
	public function edit($id_pais)
	{
		return view ('pais.edit', ['pais' => Pais :: findOrFail($id_pais)]);
	}
	
	public function update(PaisPeticion $peticion, $id_pais)
	{
        $pais = Pais:: findOrFail($id_pais);
        $pais->nombre = $peticion->get('nombre');
        $pais->update();
        return response()->json();
	}
	
	public function destroy($id_pais)
	{
		$pais = Pais :: findOrFail($id_pais);
		DB::table('pais')->where('id_pais', '=', $id_pais)->delete();
		return Redirect :: to ('pais');
	}
	public function searchPais($query)
	{
	    // Se puede mejorar
	    $paises = Pais::where('nombre','like', '%'.$query.'%')->take(10)->get();
	    return response()->json($paises);
	}
	public function getPaisById($id)
	{
	    // Se puede mejorar
	    $pais = Pais::findOrfail($id);
	    if(!is_null($pais)) {
	        $pais->ciudades;
        } else {
	        $pais->ciudades = [];
        }
        $array[] = $pais;
	    return response()->json($array);
	}
	public function addCiudadToPais(Request $request)
	{
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:50',
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        };
	    $pais = Pais::find($request['id_pais']);
	    if(!is_null($pais)) {
	        $ciudad = new Ciudad();
            $ciudad->fill($request->all());
	        $pais->ciudades()->save($ciudad);
        }
	    return response()->json($ciudad);
	}
}
