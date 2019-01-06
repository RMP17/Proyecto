<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\CuentaProveedorPeticion;
use Allison\CuentaProveedor;
use Allison\Moneda;
use Allison\Proveedor;
use DB;

class CuentaProveedorControlador extends Controller
{
    public function __construct()
	{	
	
	}
	
	public function show($id_proveedor)
	{
			$cuentas = DB::table('cuenta_proveedor as c')
			->join('proveedor as p', 'c.id_proveedor','=','p.id_proveedor')
			->join('moneda as m', 'c.id_moneda', '=', 'm.id_moneda')
			->where('c.id_proveedor', '=', $id_proveedor)
			->get();
			return view('proveedor.cuentaproveedor.show', compact('cuentas','id_proveedor'));
	}
	
	public function create($id_proveedor)
	{
		$monedas = Moneda ::orderBy('nombre', 'asc')
			->get();
		return view('proveedor.cuentaproveedor.create', compact('monedas', 'id_proveedor'));
	}
	
	public function store(CuentaProveedorPeticion $peticion)
	{
        $isRegistered = (new CuentaProveedor())->newCuenta($peticion->all());
        if(!$isRegistered) {
            return response()->json(['proveedor'=>'El proveedor no existe'], 422);
        };
        return response()->json();
	}
	
	
	public function edit($id_cuenta)
	{
		$monedas = Moneda ::orderBy('nombre', 'asc')
			->get();
		return view ('proveedor.cuentaproveedor.edit',compact('monedas'),['cuenta' => CuentaProveedor :: findOrFail($id_cuenta)]);
	}
	
	public function update(CuentaProveedorPeticion $peticion, $id_cuenta)
	{
		$cuenta = CuentaProveedor :: findOrFail($id_cuenta);
		$cuenta -> entidad= $peticion -> get('txtEntidad');
		$cuenta -> nro_cuenta= $peticion -> get('txtNroCuenta');
		$cuenta -> id_moneda= $peticion -> get('cbxMoneda');
		$cuenta->update();
		$id_proveedor=$peticion -> get('cbxProveedor');
		return Redirect :: to ('cuentaproveedor/'.$id_proveedor);
	}
	
	public function destroy(CuentaProveedorPeticion $peticion,$id_cuenta)
	{
		$cuenta = CuentaProveedor :: findOrFail($id_cuenta);
		DB::table('cuenta_proveedor')->where('id_cuenta', '=', $id_cuenta)->delete();
		$id_proveedor= $peticion -> get('cbxProveedor');
		return Redirect :: to ('cuentaproveedor/'.$id_proveedor);
	}
}
