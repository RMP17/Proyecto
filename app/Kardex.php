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
}
