<?php

namespace Allison\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\CargoPeticion;
use Allison\Cargo;
use DB;

class CargoControlador extends Controller
{
    public function index(Request $peticion)
	{
		
		if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$cargos = Cargo::where('nombre','like', '%'.$consulta.'%')
				->orderBy('nombre', 'asc')
				->paginate(10);
			return view('cargo.index', compact('cargos', 'consulta'));
		}
	}
	
	public function create()
	{
		return view('cargo.create');
	}
	
	public function store(CargoPeticion $peticion)
	{
		$cargo = new Cargo;
		$cargo -> nombre= $peticion -> get('txtNombre');
		$cargo -> save();
		return Redirect :: to ('cargo');
	}
	
	public function show($id_cargo)
	{
		return view ('cargo.show', ['cargo' => Cargo :: findOrFail($id_cargo)]);
	}
	
	public function edit($id_cargo)
	{
		return view ('cargo.edit', ['cargo' => Cargo :: findOrFail($id_cargo)]);
	}
	
	public function update(CargoPeticion $peticion, $id_cargo)
	{
		$cargo = Cargo :: findOrFail($id_cargo);
		$cargo -> nombre = $peticion -> get('txtNombre');
		$cargo->update();
		return Redirect :: to ('cargo');
	}
	
	public function destroy($id_cargo)
	{
		$cargo = Cargo :: findOrFail($id_cargo);
		DB::table('cargo')->where('id_cargo', '=', $id_cargo)->delete();
		return Redirect :: to ('cargo');
	}
}
