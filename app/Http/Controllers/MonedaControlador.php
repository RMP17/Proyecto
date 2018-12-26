<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\MonedaPeticion;
use Allison\Moneda;
use Allison\Pais;
use DB;


class MonedaControlador extends Controller
{
    public function __construct()
	{
		
	}
	
	public function index(Request $peticion)
	{
		
		if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$monedas = DB::table('moneda')
				->join('pais', 'moneda.id_pais', '=', 'pais.id_pais')
				->where('moneda.nombre', 'like', '%'.$consulta.'%')
				->select('moneda.id_moneda as id_moneda', 'moneda.nombre as nombre', 'moneda.codigo as codigo', 'moneda.id_pais as id_pais', 'pais.nombre as pais')
				->paginate(10);
			$paises = Pais::orderBy('nombre', 'asc')
				->get();
			return view('moneda.index', compact('monedas', 'consulta', 'paises'));
		}
	}
	
	public function create()
	{	
		return view('moneda.create');
	}
	
	public function store(MonedaPeticion $peticion)
	{
		$moneda = new Moneda;
		$moneda -> nombre = $peticion -> get('txtNombre');
		$moneda -> codigo = $peticion -> get('txtCodigo');
		$moneda -> id_pais = $peticion -> get('cbxPais');
		$moneda -> save();
		return Redirect :: to ('moneda');
	}
	
	public function show($id_moneda)
	{
		return view ('moneda.show', ['moneda' => Moneda :: findOrFail($id_moneda)]);
	}
	
	public function edit($id_moneda)
	{
		return view ('moneda.edit');
	}
	
	public function update(MonedaPeticion $peticion, $id_moneda)
	{
		$moneda = Moneda :: findOrFail($id_moneda);
		$moneda -> nombre = $peticion -> get('txtNombre');
		$moneda -> codigo = $peticion -> get('txtCodigo');
		$moneda -> id_pais = $peticion -> get('cbxPais');
		$moneda -> update();
		return Redirect :: to ('moneda');
	}
	
	public function destroy($id_moneda)
	{
		$moneda = Moneda :: findOrFail($id_moneda);
		DB::table('moneda')->where('id_moneda', '=', $id_moneda)->delete();
		return Redirect :: to ('moneda');
	}
}
