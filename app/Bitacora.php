<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacora';
	protected $primaryKey = 'id';
	public $timestamps = false;
	
	protected $fillable = [
		'id_empleado',
		'accion',
        'descripcion',
		'fecha',
	];
	
	protected $guarded = [
	
	];

    public static function insertInBitacora($action, $descripcion){
        $tempDescripcion='';
        switch($action)
        {
            case 'CREATE': {
                $tempDescripcion = 'data='.json_encode($descripcion);
                break;
            }
            case 'UPDATE':{
                $tempDescripcion = 'previusData='.json_encode($descripcion);
                break;
            }
            case 'DELETE':{
                $tempDescripcion = 'previusData='.json_encode($descripcion);
                break;
            }
            case 'LOGIN':
            case 'LOGOUT':break;
            default:break;
        }
        $bitacora = new Bitacora();
        $bitacora->id_empleado=auth()->user()->id_empleado;
        $bitacora->fecha=\Carbon\Carbon::now();
        $bitacora->accion=$action;
        $bitacora->descripcion=$tempDescripcion;
        $bitacora->save();
    }
}
