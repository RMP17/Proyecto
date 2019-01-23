<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
   protected $table = 'caja';
   protected $primaryKey = 'id_caja';
   public $timestamps = false;

	protected $fillable = [
		'nombre',
		'id_empleado',
	];
	protected $guarded = [
        'estatus',
	];
    public function empleado(){
        return $this->belongsTo(Empleado::class,'id_empleado');
    }

    public static function newCaja($parameters){
        $caja = new Caja();
        $caja->fill($parameters);
        $caja->save();
    }
    public static function updateCaja($parameters){
        $caja = Caja::find($parameters['id_caja']);
        $caja->fill($parameters);
        $caja->update();
    }
    public static function getCajas(){
        $cajas = Caja::select('*')->orderBy('nombre')->get();
        foreach ($cajas as $caja) {
            $empleado=[
                'nombre' => $caja->empleado->nombre,
                'id_empelado' => $caja->empleado->id_empleado
            ];
            unset($caja->empleado);
            $caja->empleado=$empleado;
        }
        return $cajas;
    }

}
