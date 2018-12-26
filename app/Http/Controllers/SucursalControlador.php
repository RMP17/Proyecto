<?php

namespace Allison\Http\Controllers;
use Allison\Http\Controllers\ConversorImagenes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\SucursalPeticion;
use Allison\Empresa;
use Allison\Pais;
use Allison\Ciudad;
use Allison\Sucursal;
use DB;

class SucursalControlador extends Controller
{
    public function __construct()
	{
		
	}
	
    public function show($id_empresa)
	{
			$sucursales = DB::table('sucursal as s')
			->join('ciudad as c', 'c.id_ciudad', '=', 's.id_ciudad')
			->select('s.id_sucursal','s.nombre as nombre_sucursal','s.direccion','s.telefono','s.fecha_apertura', 's.estatus','c.nombre as nombre_ciudad' )
			->where('s.id_empresa', '=', $id_empresa)
			->get();
			return view('sucursal.show', compact('sucursales','id_empresa'));
	}

	public function create($id_empresa)
	{

		$paises = Pais::orderBy('nombre', 'asc')
			->get();
		return view('sucursal.create', compact('paises','id_empresa'));
	}
	
	public function store(SucursalPeticion $peticion)
	{
		$sucursal = new Sucursal;
		$sucursal -> nombre = $peticion -> get('txtNombre');
		$sucursal -> casa_matriz = $peticion -> get('rbtCasaMatriz');
		$sucursal -> direccion = $peticion -> get('txtDireccion');
		$sucursal -> telefono = $peticion -> get('txtTelefono');
		$sucursal -> fecha_apertura = date("Y-m-d", strtotime($peticion -> get('dtmFechaApertura')));
		$sucursal -> estatus = 'A';
		$sucursal -> id_ciudad = $peticion -> get('cbxCiudad');
		$sucursal -> id_empresa = $peticion -> get('cbxEmpresa');
		$sucursal -> save();
		$id_empresa= $peticion -> get('cbxEmpresa');
		return Redirect :: to ('sucursal/'.$id_empresa);
	}
	public function edit($id_sucursal)
	{
		$paises = Pais::orderBy('nombre', 'asc')
			->get();
		$sucursal = Sucursal :: findOrFail($id_sucursal);
		$id_ciudad = $sucursal -> id_ciudad;
		$ciudad = Ciudad :: findOrFail($id_ciudad);
		$id_pais = $ciudad -> id_pais;
		$pais = Pais :: findOrFail ($id_pais);
		return view ('sucursal.edit',compact('sucursal', 'paises', 'pais', 'ciudad'));
	}
	
	public function update(SucursalPeticion $peticion)
	{
		$sucursal = new Sucursal;
		$sucursal -> nombre = $peticion -> get('txtNombre');
		$sucursal -> casa_matriz = $peticion -> get('rbtCasaMatriz');
		$sucursal -> direccion = $peticion -> get('txtDireccion');
		$sucursal -> telefono = $peticion -> get('txtTelefono');
		$sucursal -> fecha_apertura = date("Y-m-d", strtotime($peticion -> get('dtmFechaApertura')));
		$sucursal -> id_ciudad = $peticion -> get('cbxCiudad');
		$sucursal->update();
		$id_empresa=$peticion -> get('cbxEmpresa');
		return Redirect :: to ('sucursal/'.$id_empresa);
	}
	
	public function destroy(Request $peticion,$id_sucursal)
	{
		$sucursal = Sucursal :: findOrFail($id_sucursal);
		$sucursal->estatus = 'X';
		$sucursal->update();
		$id_empresa=$peticion -> get('cbxEmpresa');
		return Redirect :: to ('sucursal/'.$id_empresa);

	}
	
	public function SucursalesPorCiudad(Request $peticion, $id_ciudad)
	{
		if($peticion->ajax())
		{
			$sucursales = Sucursal::where('id_ciudad', '=', $id_ciudad)
				->get();
			return response()->json($sucursales);
		}
	}
}
