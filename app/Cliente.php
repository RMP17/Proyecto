<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
	protected $primaryKey = 'id_cliente';
	public $timestamps = false;
	
	protected $fillable = [
		'razon_social',
		'nit',
		'actividad',
		'telefono',
		'celular',
		'correo',
		'direccion',
		'id_ciudad',
	];
	
	protected $guarded = [
	
	];
    public static function newCliente($parameters){
        $_empleado = new Cliente();
        $_empleado->fill($parameters);
        $_empleado->save();
        return $_empleado;
    }
    public static function suggestionsClients($query){
        $clientes = Cliente::where('razon_social', 'like','%'.$query.'%')->orderBy('razon_social','desc')->take(10)->get();
        return $clientes;
    }
    public static function getClientByNit($nit){
        $cliente = Cliente::where('nit',$nit)->first();
        if(is_null($cliente)){
            $cliente = new Cliente();
        }
        return $cliente;
    }
}
