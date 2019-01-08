<?php

namespace Allison\Http\Controllers;

use Allison\Http\Requests\SucursalPeticion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\EmpresaPeticion;
use Allison\Empresa;

class EmpresaControlador extends Controller
{
     public function __construct()
	{
		
	}
	
	public function index()
	{
	    $empresa = Empresa::getEmpresas();
	    return response()->json($empresa);
	}
	
	public function create()
	{
		return view('empresa.create');
	}
	
	public function store(EmpresaPeticion $peticion)
	{
	    Empresa::newEmpresa($peticion->all());
		return response()->json();
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
	    Empresa::updateEmpresa($peticion->all(),$id_empresa);
		return  response()->json();
	}
	
	public function destroy($id_empresa)
	{
		$empresa = Empresa :: findOrFail($id_empresa);
		DB::table('empresa')->where('id_empresa', '=', $id_empresa)->delete();
		return Redirect :: to ('empresa');
	}
	public function addSucursalToEmpresa(SucursalPeticion $request, $id_empresa)
	{
	    Empresa::addSucursalToEmpresa($request->all(), $id_empresa);
	    return response()->json();
	}
}
