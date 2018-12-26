<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\KardexObservacionesPeticion;
use Allison\KardexObservaciones;
use DB;

class KardexObservacionesControlador extends Controller
{
    public function __construct()
	{
		
	}
	public function show(Request $peticion, $id_kardex){
		if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$kardexO = KardexObservaciones ::where('id_kardex', '=', $id_kardex)
				->paginate(10);
			return view('kardex.kardex_observaciones.show', compact('kardexO', 'id_kardex'));
		}
	}
	
	public function create($id_kardex)
	{
		return view('kardex.kardex_observaciones.create', compact('id_kardex'));
	}
	
	public function store(KardexObservacionesPeticion $peticion)
	{
		$kardexO = new KardexObservaciones;
		$kardexO -> observacion = $peticion -> get('txtObservacion');
		$kardexO -> fecha = date("Y-m-d", time());
		$kardexO -> id_kardex = $peticion -> get('cbxKardex');
		$kardexO -> save();
		$id_kardex=$peticion -> get('cbxKardex');
		return Redirect :: to ('kardexO/'.$id_kardex);
	}
	public function edit($id_kardex)
	{
		return view ('kardex.kardex_observaciones.edit', ['kardexO' => KardexObservaciones:: findOrFail($id_kardex)]);
	}
	
	public function update(KardexPeticion $peticion, $id_kardex)
	{
		$kardexO = KardexObservaciones :: findOrFail($id_kardex);
		$kardexO -> observacion = $peticion -> get('txtObservacion');
		$kardexO -> id_kardex = $peticion -> get('cbxKardex');
		$kardexO->update();
		$id_kardex=$peticion -> get('cbxKardex');
		return Redirect :: to ('kardexO/'.$id_kardex);
	}
	public function destroy($id_kardex)
	{
		$kardexO = KardexObservaciones :: findOrFail($id_kardex);
		DB::table('kardex_observaciones')->where('id_kardex', '=', $id_kardex)->delete();
		return Redirect :: to ('kardex');
	}
	
}
