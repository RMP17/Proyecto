<?php

namespace Allison\Http\Controllers;

use Allison\Http\Resources\ProveedorResource;
use Allison\Http\Resources\ProveedorSuggestionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\ProveedorPeticion;
use Allison\Proveedor;
use Allison\Pais;
use Allison\Ciudad;


class ProveedorControlador extends Controller
{
    public function index()
	{
        $proveedores = (new Proveedor())->getProveedores();
        return ProveedorResource::collection($proveedores);
	}
	
	public function create()
	{
		$paises = Pais::orderBy('nombre', 'asc')
			->get();
		return view('proveedor.create', compact('paises'));
	}
	
	public function store(ProveedorPeticion $peticion)
	{
        (new Proveedor())->newProveedor($peticion->all());
		return response()->json();
	}
	
	public function show($id_proveedor)
	{
		return view ('proveedor.show', ['proveedor' => Proveedor :: findOrFail($id_proveedor)]);
	}
	
	public function edit($id_proveedor)
	{
		$paises = Pais::orderBy('nombre', 'asc')
			->get();
		$proveedor = Proveedor :: findOrFail($id_proveedor);
		$id_ciudad = $proveedor -> id_ciudad;
		$ciudad = Ciudad :: findOrFail($id_ciudad);
		$id_pais = $ciudad -> id_pais;
		$pais = Pais :: findOrFail ($id_pais);
		return view ('proveedor.edit',compact('proveedor', 'paises', 'pais', 'ciudad'));;
	}
	
	public function update(ProveedorPeticion $peticion, $id_proveedor)
	{
        (new Proveedor())->updateProveedor($peticion->all(),$id_proveedor);
		return response()->json();
	}
	
	public function destroy(ProveedorPeticion $peticion,$id_proveedor)
	{
		$proveedor= Proveedor :: findOrFail($id_proveedor);
		DB::table('proveedor')->where('id_proveedor', '=', $id_proveedor)->delete();
		return Redirect :: to ('proveedor');
	}
	public function suggestionsProveedores($query)
	{
		$proveedor = Proveedor::suggestionsProveedor($query);
		return ProveedorSuggestionResource::collection($proveedor);
	}
	public function getContactosOfProveedor($id_proveedor)
	{
		$contactos = Proveedor::getContactosOfProveedor($id_proveedor);
		return response()->json($contactos);
	}

}
