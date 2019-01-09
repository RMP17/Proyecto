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
		/*if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$empleados = DB::table('empleado')
				->join('sucursal', 'empleado.id_sucursal', '=', 'sucursal.id_sucursal')
				->where('empleado.nombre', 'like', '%'.$consulta.'%')
				->orderBy('nombre', 'asc')
				->select('empleado.id_empleado as id_empleado', 
							'empleado.nombre as nombre',  
							'empleado.ci as ci',
							'empleado.sexo as sexo',
							'empleado.fecha_nacimiento as fecha_nacimiento', 
							'empleado.telefono as telefono', 
							'empleado.celular as celular', 
							'empleado.correo as correo',
							'empleado.direccion as direccion', 
							'empleado.foto as foto', 
							'empleado.persona_referencia as persona_referencia', 
							'empleado.telefono_referencia as telefono_referencia', 
							'empleado.fecha_registro as fecha_registro', 
							'empleado.estatus as estatus', 
							'empleado.id_sucursal as id_sucursal', 
							'sucursal.nombre as sucursal',
							DB::raw('DATEDIFF(curdate(), empleado.fecha_nacimiento) as edad'))
				->get();
			$paises = Pais::orderBy('nombre', 'asc')
			->get();
			$cargos = Cargo ::orderBy('nombre','asc')
			->get();
			$monedas= Moneda ::orderBy('nombre', 'asc')->get();
			return view('empleado.index', compact('empleados', 'consulta', 'paises','cargos','monedas'));*/

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
	    Empleado::newEmpleado($peticion->all());
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
		$conversor = new ConversorImagenes;
		$empleado = Empleado :: findOrFail($id_empleado);
		$empleado -> nombre = $peticion -> get('txtNombre');
		$empleado -> ci = $peticion -> get('txtCi');
		$empleado -> sexo = $peticion -> get('rbtSexo');
		$empleado -> fecha_nacimiento = date("Y-m-d", strtotime($peticion -> get('dtmFechaNacimiento')));   // datepicker-autoclose" placeholder="mm/dd/yyyy" name="dtmFechaNacimiento
		$empleado -> telefono = $peticion -> get('txtTelefono');
		$empleado -> celular = $peticion -> get('txtCelular');
		$empleado -> correo = $peticion -> get('txtCorreo');
		$empleado -> direccion = $peticion -> get('txtDireccion');
		if ($peticion -> get('imgFoto') != null)
			$empleado -> foto = $conversor->ImagenABinario($peticion -> get('imgFoto'));
		$empleado -> persona_referencia = $peticion -> get('txtPersonaReferencia');
		$empleado -> telefono_referencia = $peticion -> get('txtTelefonoReferencia');
		$empleado -> id_sucursal = $peticion -> get('cbxSucursal');
		$empleado->update();
		return Redirect :: to ('empleado');
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
