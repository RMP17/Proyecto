<?php

namespace Allison\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\CargoPeticion;
use Allison\Cargo;
use DB;
use Allison\Bitacora;

class CargoControlador extends Controller
{
    public function index()
	{
		$cargo = Cargo::select('*')->orderBy('nombre', 'asc')->get();
		return response()->json($cargo);
	}

	public function store(CargoPeticion $peticion)
	{
		$cargo = new Cargo;
		$cargo->fill($peticion->all());
		$cargo -> save();
		return response()->json();
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
        $cargo = Cargo::findOrFail($id_cargo);
        Bitacora::insertInBitacora('UPDATE', $cargo);
		$cargo->fill($peticion->all());
		$cargo->update();
		return response()->json();
	}
	
	public function destroy($id_cargo)
	{

	}
}
