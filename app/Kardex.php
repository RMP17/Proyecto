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
		'fecha_registro',
		'id_empleado',
		'id_cargo',
		'id_tipo_empleado',
	];
	
	protected $guarded = [
	
	];
	
}
