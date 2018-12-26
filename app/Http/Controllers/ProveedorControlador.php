<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\ProveedorPeticion;
use Allison\Proveedor;
use Allison\Pais;
use Allison\Ciudad;
use DB;


class ProveedorControlador extends Controller
{
    public function index(Request $peticion)
	{	
		if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$proveedores = Proveedor::where('razon_social', 'like', '%'.$consulta.'%')
				->orderBy('razon_social', 'asc')
				->get();
			return view('proveedor.index', compact('proveedores', 'consulta'));
		}
	}
	
	public function create()
	{
		$paises = Pais::orderBy('nombre', 'asc')
			->get();
		return view('proveedor.create', compact('paises'));
	}
	
	public function store(ProveedorPeticion $peticion)
	{
		$proveedor = new Proveedor;
		$proveedor -> razon_social = $peticion -> get('txtRazonSocial');
		$proveedor -> nit = $peticion -> get('txtNit');
		$proveedor -> telefono = $peticion -> get('txtTelefono');
		$proveedor -> fax = $peticion -> get('txtFax');
		$proveedor -> celular = $peticion -> get('txtCelular');
		$proveedor -> correo = $peticion -> get('txtCorreo');
		$proveedor -> sitio_web = $peticion -> get('txtSitioWeb');
		$proveedor -> direccion = $peticion -> get('txtDireccion');
		$proveedor -> fecha_registro = date('Y-m-d', time());
		$proveedor -> rubro = $peticion -> get('txtRubro');
		$proveedor -> id_ciudad = $peticion -> get('cbxCiudad');
		$proveedor -> save();
		return Redirect :: to ('proveedor');
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
		$proveedor = Proveedor :: findOrFail($id_proveedor);
		$proveedor -> razon_social = $peticion -> get('txtRazonSocial');
		$proveedor -> nit = $peticion -> get('txtNit');
		$proveedor -> telefono = $peticion -> get('txtTelefono');
		$proveedor -> fax = $peticion -> get('txtFax');
		$proveedor -> celular = $peticion -> get('txtCelular');
		$proveedor -> correo = $peticion -> get('txtCorreo');
		$proveedor -> sitio_web = $peticion -> get('txtSitioWeb');
		$proveedor -> direccion = $peticion -> get('txtDireccion');
		$proveedor -> rubro = $peticion -> get('txtRubro');
		$proveedor -> id_ciudad = $peticion -> get('cbxCiudad');
		$proveedor->update();
		return Redirect :: to ('proveedor');
	}
	
	public function destroy(ProveedorPeticion $peticion,$id_proveedor)
	{
		$proveedor= Proveedor :: findOrFail($id_proveedor);
		DB::table('proveedor')->where('id_proveedor', '=', $id_proveedor)->delete();
		return Redirect :: to ('proveedor');
	}
}
