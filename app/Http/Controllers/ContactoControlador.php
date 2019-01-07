<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\ContactoPeticion;
use Allison\Contacto;
use Allison\Proveedor;
use Allison\Cargo;
use DB;

class ContactoControlador extends Controller
{
     public function index(Request $peticion)
	{	
		if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$contactos = Contacto::where('nombre', 'like', '%'.$consulta.'%')
				->orderBy('nombre', 'asc')
				->get();
			return view('contacto.index', compact('contactos', 'consulta'));
		}
	}
	
	public function create()
	{
		$cargos = Cargo ::orderBy('nombre', 'asc')
			->get();
		$proveedores = Proveedor ::orderBy('razon_social', 'asc')
			->get();

		return view('contacto.create', compact('cargos','proveedores'));
	}
	
	public function store(ContactoPeticion $peticion)
	{
	    Contacto::newContacto($peticion->all());
		return response()->json();
	}
	
	public function show($id_contacto)
	{
		return view ('contacto.show', ['contacto' => Contacto :: findOrFail($id_contacto)]);
	}
	
	public function edit($id_contacto)
	{
		$cargos = Cargo ::orderBy('nombre', 'asc')
			->get();
		$proveedores = Proveedor ::orderBy('razon_social', 'asc')
			->get();
		$contacto = Contacto :: findOrFail($id_contacto);

		return view('contacto.edit', compact('contacto','cargos','proveedores'));
	}
	
	public function update(ContactoPeticion $peticion, $id_contacto)
	{
		$contacto = Contacto :: findOrFail($id_contacto);
		$contacto -> nombre = $peticion -> get('txtNombre');
		$contacto -> telefono = $peticion -> get('txtTelefono');
		$contacto -> celular = $peticion -> get('txtCelular');
		$contacto -> interno = $peticion -> get('txtInterno');
		$contacto -> correo = $peticion -> get('txtCorreo');
		$contacto -> id_cargo = $peticion -> get('cbxCargo');
		$contacto -> id_proveedor = $peticion -> get('cbxProveedor');
		$contacto -> update();
		return Redirect :: to ('contacto');
	}
	
	public function destroy($id_contacto)
	{
		$contacto = Contacto :: findOrFail($id_contacto);
		$contacto->estatus = 'X';
		$contacto->update();
		return Redirect :: to ('contacto');
	}
}
