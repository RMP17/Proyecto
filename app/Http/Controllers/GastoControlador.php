<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\GastoPeticion;
use Allison\Gasto;
use DB;

class GastoControlador extends Controller
{
	public function show(Request $peticion, $id_caja_chica){
		if ($peticion)
		{
			$gastos = Gasto :: where('id_caja_chica', '=', $id_caja_chica)
				->paginate(10);
			return view('cajachica.gasto.show', compact('gastos', 'id_caja_chica'));
		}
	}

	public function create($id_caja_chica)
	{
		return view('cajachica.gasto.create', compact('id_caja_chica'));
	}
	
	public function store(GastoPeticion $peticion)
	{
		$gasto = new Gasto;
		$gasto -> monto= $peticion -> get('txtMonto');
		$gasto -> descripcion= $peticion -> get('txtDescripcion');
		$gasto -> id_caja_chica= $peticion -> get('txtCajaChica');
		$gasto -> save();
		$id_caja_chica= $peticion -> get('txtCajaChica');
		return Redirect :: to ('gasto/'.$id_caja_chica);
	}
}
