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
}
