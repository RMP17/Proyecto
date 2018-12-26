<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\EmpresaPeticion;
use Allison\Empresa;
use DB;

class EmpresaControlador extends Controller
{
     public function __construct()
	{
		
	}
	
	public function index(Request $peticion)
	{
		
		if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$empresas = Empresa::where('razon_social','like', '%'.$consulta.'%')
				->orderBy('razon_social', 'asc')
				->paginate(10);
			return view('empresa.index', compact('empresas', 'consulta'));
		}
	}
	
	public function create()
	{
		return view('empresa.create');
	}
	
	public function store(EmpresaPeticion $peticion)
	{
		$empresa = new Empresa;
		$empresa -> razon_social= $peticion -> get('txtRazon_social');
		$empresa -> nit= $peticion -> get('txtNit');
		$empresa -> propietario= $peticion -> get('txtPropietario');
		$empresa -> actividad= $peticion -> get('txtActividad');
		$empresa -> save();
		return Redirect :: to ('empresa');
	}
	
	public function show($id_empresa)
	{
		return view ('empresa.show', ['empresa' => Empresa :: findOrFail($id_empresa)]);
	}
	
	public function edit($id_empresa)
	{
		return view ('empresa.edit', ['empresa' => Empresa :: findOrFail($id_empresa)]);
	}
	
	public function update(EmpresaPeticion $peticion, $id_empresa)
	{
		$empresa = Empresa :: findOrFail($id_empresa);
		$empresa -> razon_social = $peticion -> get('txtRazon_social');
		$empresa -> nit= $peticion -> get('txtNit');
		$empresa -> propietario= $peticion -> get('txtPropietario');
		$empresa -> actividad= $peticion -> get('txtActividad');
		$empresa->update();
		return Redirect :: to ('empresa');
	}
	
	public function destroy($id_empresa)
	{
		$empresa = Empresa :: findOrFail($id_empresa);
		DB::table('empresa')->where('id_empresa', '=', $id_empresa)->delete();
		return Redirect :: to ('empresa');
	}
}
