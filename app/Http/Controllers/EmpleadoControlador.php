<?php
namespace Allison\Http\Controllers;
use Allison\Http\Controllers\ConversorImagenes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\EmpleadoPeticion;
use Allison\Empleado;
use Allison\Pais;
use Allison\Ciudad;
use Allison\Sucursal;
use Allison\Kardex;
use Allison\Salario;
use Allison\Moneda;
use Allison\Cargo;
use DB;

class EmpleadoControlador extends Controller
{
    public function __construct()
	{	
	}
	public function index(Request $peticion)
	{
		$empleados = Empleado::getEmpleados();
		return response()->json($empleados);

	}
	public function create()
	{
		$paises = Pais::orderBy('nombre', 'asc')
			->get();
		$cargos = Cargo ::orderBy('nombre','asc')
			->get();
		$monedas= Moneda ::orderBy('nombre', 'asc')->get();
		
		return view('empleado.create', compact('paises','cargos', 'monedas'));
	}
	
	public function store(EmpleadoPeticion $peticion)
	{
	    Empleado::newEmpleado($peticion);
	    return response()->json();
		/*if(sizeof($kardexActiva) == 0)*/
	}
	public function show($id_empleado)
	{
		return view ('empleado.show', ['empleado' => Empleado :: findOrFail($id_empleado)]);
	}
	public function edit($id_empleado)
	{
		$paises = Pais::orderBy('nombre', 'asc')
			->get();
		$empleado = Empleado :: findOrFail($id_empleado);
		$id_sucursal = $empleado -> id_sucursal;
		$sucursal = Sucursal :: findOrFail($id_sucursal);
		$id_ciudad = $sucursal -> id_ciudad;
		$ciudad = Ciudad :: findOrFail($id_ciudad);
		$id_pais = $ciudad -> id_pais;
		$pais = Pais :: findOrFail ($id_pais);

		return view ('empleado.edit', compact ('empleado', 'paises', 'pais', 'ciudad', 'sucursal'));
	}
	
	public function update(EmpleadoPeticion $peticion, $id_empleado)
	{
        Empleado::updateEmpleado($peticion, $id_empleado);
        return response()->json();
	}
	
	public function destroy($id_empleado)
	{
		$empleado = Empleado :: findOrFail($id_empleado);
		$empleado->estatus = 'X';
		$empleado->update();
		return Redirect :: to ('empleado');
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
