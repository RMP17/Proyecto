<?php

namespace Allison\Http\Controllers;
use Allison\Http\Controllers\ConversorImagenes;
use Allison\Http\Requests\VentaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Venta;
use Allison\DetalleVenta;
use Allison\Articulo;
use Allison\Cliente;
use Allison\Caja;

class VentaControlador extends Controller
{
    public function __construct()
	{
		
	}
	
	public function index()
	{
        return view('venta.index');
	}
	
	public function create()
	{
		$paises = Pais::orderBy('nombre', 'asc')
			->get();
		return view('venta.create', compact('paises'));
	}
	
	public function store(VentaRequest $request)
	{
		$venta = Venta::newVenta($request->all());
		if (!is_null($venta)){
		    return response()->json($venta['message'], $venta['code']);
        } else{
            return response()->json();
        }
	}
	
	public function show($id_empleado)
	{
		return view ('venta.show', ['venta' => Empleado :: findOrFail($id_empleado)]);
	}
	
	public function edit($id_empleado)
	{
		$paises = Pais::orderBy('nombre', 'asc')
			->get();
		$venta = Empleado :: findOrFail($id_empleado);
		$id_sucursal = $venta -> id_sucursal;
		$sucursal = Sucursal :: findOrFail($id_sucursal);
		$id_ciudad = $sucursal -> id_ciudad;
		$ciudad = Ciudad :: findOrFail($id_ciudad);
		$id_pais = $ciudad -> id_pais;
		$pais = Pais :: findOrFail ($id_pais);
		return view ('venta.edit', compact ('venta', 'paises', 'pais', 'ciudad', 'sucursal'));
	}
	
	public function update(EmpleadoPeticion $peticion, $id_empleado)
	{
		$conversor = new ConversorImagenes;
		$venta = Empleado :: findOrFail($id_empleado);
		$venta -> nombre = $peticion -> get('txtNombre');
		$venta -> ci = $peticion -> get('txtCi');
		$venta -> sexo = $peticion -> get('rbtSexo');
		$venta -> fecha_nacimiento = date("Y-m-d", strtotime($peticion -> get('dtmFechaNacimiento')));   // datepicker-autoclose" placeholder="mm/dd/yyyy" name="dtmFechaNacimiento
		$venta -> telefono = $peticion -> get('txtTelefono');
		$venta -> celular = $peticion -> get('txtCelular');
		$venta -> correo = $peticion -> get('txtCorreo');
		$venta -> direccion = $peticion -> get('txtDireccion');
		if ($peticion -> get('imgFoto') != null)
			$venta -> foto = $conversor->ImagenABinario($peticion -> get('imgFoto'));
		$venta -> persona_referencia = $peticion -> get('txtPersonaReferencia');
		$venta -> telefono_referencia = $peticion -> get('txtTelefonoReferencia');
		$venta -> id_sucursal = $peticion -> get('cbxSucursal');
		$venta->update();
		return Redirect :: to ('venta');
	}
	
	public function destroy($id_empleado)
	{
		$venta = Empleado :: findOrFail($id_empleado);
		$venta->estatus = 'X';
		$venta->update();
		return Redirect :: to ('venta');
	}
	
	public function EmpleadosPorSucursal(Request $peticion, $id_sucursal)
	{
		if($peticion->ajax())
		{
			$empleados = Empleado::where('id_sucursal', '=', $id_sucursal)
				->where('estatus', '=', 'A')
				->get();
			return response()->json($empleados);
		}
	}
}
