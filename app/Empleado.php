<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleado';
	protected $primaryKey = 'id_empleado';
	public $timestamps = false;
	
	protected $fillable = [
		'nombre',
		'ci',
		'sexo',
		'fecha_nacimiento',
		'telefono',
		'celular',
		'correo',
		'direccion',
		'foto',
		'persona_referencia',
		'telefono_referencia',
		'fecha_registro',
		'estatus',
		'id_sucursal',
	];
	
	protected $guarded = [
	
	];
}
