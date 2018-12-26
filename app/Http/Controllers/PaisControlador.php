<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\PaisPeticion;
use Allison\Pais;
use DB;


class PaisControlador extends Controller
{
    public function __construct()
	{
		
	}
	
	public function index(Request $peticion)
	{
		
		if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$paises = Pais::where('nombre', 'like', '%'.$consulta.'%')
				->orderBy('nombre', 'asc')
				->paginate(10);
			return view('pais.index', compact('paises', 'consulta'));
		}
	}
	
	public function create()
	{
		return view('pais.create');
	}
	
	public function store(PaisPeticion $peticion)
	{
		$pais = new Pais;
		$pais -> nombre = $peticion -> get('txtNombre');
		$pais -> save();
		return Redirect :: to ('pais');
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
		$pais = Pais :: findOrFail($id_pais);
		$pais -> nombre = $peticion -> get('txtNombre');
		$pais -> update();
		return Redirect :: to ('pais');
	}
	
	public function destroy($id_pais)
	{
		$pais = Pais :: findOrFail($id_pais);
		DB::table('pais')->where('id_pais', '=', $id_pais)->delete();
		return Redirect :: to ('pais');
	}
}
