<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\ClientePeticion;
use Allison\Cliente;
use Allison\Ciudad;
use Allison\Pais;
use DB;

class ClienteControlador extends Controller
{
     public function __construct()
	{
		
	}
	
	public function index(Request $peticion)
	{
		
		if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$clientes = Cliente::where('razon_social','like', '%'.$consulta.'%')
				->orderBy('razon_social', 'asc')
				->paginate(10);
			return view('cliente.index', compact('clientes', 'consulta'));
		}
	}
	public function CiudadesPorPais(Request $peticion, $id_pais)
	{
		if($peticion->ajax())
		{
			$ciudades = Ciudad::where('id_pais', '=', $id_pais)
				->get();
			return response()->json($ciudades);
		}
	}
    public function create()
	{
		$paises = Pais::orderBy('nombre', 'asc')
			->get();
		$ciudades = Ciudad::orderBy('nombre','asc')
			->get();
		return view('cliente.create', compact('paises', 'ciudades'));

	
	}
	public function store(ClientePeticion $peticion)
	{
		$cliente = new Cliente;
		$cliente -> razon_social= $peticion -> get('txtRazonSocial');
		$cliente -> nit= $peticion -> get('txtNit');
		$cliente -> actividad= $peticion -> get('txtActividad');
		$cliente -> celular= $peticion -> get('txtCelular');
		$cliente -> telefono= $peticion -> get('txtTelefono');
		$cliente -> correo= $peticion -> get('txtCorreo');
		$cliente -> direccion= $peticion -> get('txtDireccion');
		$cliente -> id_ciudad= $peticion -> get('cbxCiudad');
		$cliente -> save();
		return Redirect :: to ('cliente');
	}
	public function show($id_cliente)
	{

		return view ('cliente.show', ['cliente' => Cliente :: findOrFail($id_cliente)]);
	}
	
	public function edit($id_cliente)
	{
		$paises = Pais::orderBy('nombre', 'asc')
			->get();
		$cliente = Cliente :: findOrFail($id_cliente);
		$id_ciudad = $cliente -> id_ciudad;
		$ciudad = Ciudad :: findOrFail($id_ciudad);
		$id_pais = $ciudad -> id_pais;
		$pais = Pais :: findOrFail ($id_pais);
		return view ('cliente.edit',compact('cliente', 'paises', 'pais', 'ciudad'));
	}
	
	public function update(ClientePeticion $peticion, $id_cliente)
	{
		$cliente = Cliente :: findOrFail($id_cliente);
		$cliente -> razon_social = $peticion -> get('txtRazonSocial');
		$cliente -> nit= $peticion -> get('txtNit');
		$cliente -> actividad= $peticion -> get('txtActividad');
		$cliente -> celular= $peticion -> get('txtCelular');
		$cliente -> telefono= $peticion -> get('txtTelefono');
		$cliente -> correo= $peticion -> get('txtCorreo');
		$cliente -> direccion= $peticion -> get('txtDireccion');
		$cliente -> id_ciudad= $peticion -> get('cbxCiudad');
		$cliente->update();
		return Redirect :: to ('cliente');
	}
	
}
