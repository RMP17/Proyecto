<?php
namespace Allison\Http\Controllers;
use Allison\Http\Controllers\ConversorImagenes;
use Allison\Http\Resources\SimpleSuggestionsEmpleadosResource;
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
	}
	public function show($id_empleado)
	{
		return view ('empleado.show', ['empleado' => Empleado :: findOrFail($id_empleado)]);
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
	public function simpleSuggestionsEmpleado($query)
	{
        $empleados = Empleado::simpleSuggestionsEmpleado($query);

	    return SimpleSuggestionsEmpleadosResource::collection($empleados);
	}
	public function changeStatus($id_empleado)
	{
        $empleado = Empleado::find($id_empleado);
        $empleado->changeStatus();
	    return response()->json();
	}
}
