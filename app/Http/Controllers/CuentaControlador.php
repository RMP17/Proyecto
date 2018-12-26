<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\CuentaPeticion;
use Allison\Cuenta;
use Allison\Moneda;
use Allison\Empresa;
use DB;

class CuentaControlador extends Controller
{
    public function __construct()
	{	
	
	}
	
	public function index(Request $peticion)
	{
		
		if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$cuentas = DB::table('cuenta as c')
				->join('empresa as e', 'c.id_empresa','=','e.id_empresa')
				->join('moneda as m', 'c.id_moneda', '=', 'm.id_moneda')
				->where('nro_cuenta','like','%',$consulta,'%')
				->paginate(10);
			return view('empresa.cuenta.index', compact('cuentas', 'consulta'));
		}
	}
	public function show($id_empresa)
	{
			$cuentas = DB::table('cuenta as c')
				->join('empresa as e', 'c.id_empresa','=','e.id_empresa')
				->join('moneda as m', 'c.id_moneda', '=', 'm.id_moneda')
				->where('c.id_empresa', '=', $id_empresa)
				->get();
			return view('empresa.cuenta.show', compact('cuentas','id_empresa'));
	}
	
	public function create($id_empresa)
	{
		$monedas = Moneda ::orderBy('nombre', 'asc')
			->get();
		return view('empresa.cuenta.create', compact('monedas', 'id_empresa'));
	}
	
	public function store(CuentaPeticion $peticion)
	{
		$cuenta = new Cuenta;
		$cuenta -> entidad= $peticion -> get('txtEntidad');
		$cuenta -> nro_cuenta= $peticion -> get('txtNroCuenta');
		$cuenta -> id_moneda= $peticion -> get('cbxMoneda');
		$cuenta -> id_empresa= $peticion -> get('cbxEmpresa');
		$cuenta -> save();
		$id_empresa= $peticion -> get('cbxEmpresa');
		return Redirect :: to ('cuenta/'.$id_empresa);
	}
	
	public function edit($id_cuenta)
	{
		$monedas = Moneda ::orderBy('nombre', 'asc')
			->get();
		return view ('empresa.cuenta.edit',compact('monedas'),['cuenta' => Cuenta :: findOrFail($id_cuenta)]);
	}
	
	public function update(CuentaPeticion $peticion, $id_cuenta)
	{
		$cuenta = Cuenta :: findOrFail($id_cuenta);
		$cuenta -> entidad= $peticion -> get('txtEntidad');
		$cuenta -> nro_cuenta= $peticion -> get('txtNroCuenta');
		$cuenta -> id_moneda= $peticion -> get('cbxMoneda');
		$cuenta -> id_empresa= $peticion -> get('cbxEmpresa');
		$cuenta->update();
		$id_empresa=$peticion -> get('cbxEmpresa');
		return Redirect :: to ('cuenta/'.$id_empresa);
	}
	
	public function destroy(CuentaPeticion $peticion,$id_cuenta)
	{
		$cuenta = Cuenta :: findOrFail($id_cuenta);
		DB::table('cuenta')->where('id_cuenta', '=', $id_cuenta)->delete();
		$id_empresa= $peticion -> get('cbxEmpresa');
		return Redirect :: to ('cuenta/'.$id_empresa);
	}
}
