<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
	
    protected $table = 'kardex';
	protected $primaryKey = 'id_kardex';
	public $timestamps = false;
	
	protected $fillable = [
		'fecha_inicio',
		'fecha_baja',
		'id_empleado',
		'id_cargo',
		'id_tipo_empleado',
	];
	
	protected $guarded = [
	
	];

    public function salario(){
        return $this->hasOne(Salario::class,'id_kardex','id_kardex');
    }
    public function kardexObservaciones(){
        return $this->hasMany(KardexObservaciones::class,'id_kardex','id_kardex');
    }
    public function cargo(){
        return $this->belongsTo(Cargo::class,'id_cargo');
    }

    public static function getKardexEmpleado($id_empleado){
        $kardex = Kardex::where('id_empleado',$id_empleado)->orderBy('fecha_inicio','desc')->get();
        foreach ($kardex as $_kardex) {
            $_kardex->kardexObservaciones;
            $_kardex->cargo;
            $salario = $_kardex->salario;
            if(!is_null($salario)) {
                $_kardex->salario->simbolo = Moneda::find($salario->id_moneda)->codigo;
            } else {
                $_kardex->salario = null;
            }
        }
        return $kardex;
    }

}
