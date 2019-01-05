<?php

namespace Allison\Http\Controllers;

use Allison\Http\Resources\MonedaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\MonedaPeticion;
use Allison\Moneda;


class MonedaControlador extends Controller
{
    public function __construct()
	{
		
	}
	public function index()
	{
	    $monedas= Moneda::select()->orderBy('nombre','asc')->get();
	    return MonedaResource::collection($monedas);
	}
	
	public function create()
	{	
		return view('moneda.create');
	}
	
	public function store(MonedaPeticion $peticion)
	{
		$moneda = new Moneda;
		$moneda = $moneda->fill($peticion->all());
		$moneda -> save();
		return response()->json();
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
		$moneda->fill($peticion->all());
		$moneda -> update();
		return response()->json();
	}
	
	public function destroy($id_moneda)
	{
		$moneda = Moneda :: findOrFail($id_moneda);
		DB::table('moneda')->where('id_moneda', '=', $id_moneda)->delete();
		return Redirect :: to ('moneda');
	}
}
