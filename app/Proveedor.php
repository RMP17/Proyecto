<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{ 
    protected $table = 'proveedor';
	protected $primaryKey = 'id_proveedor';
	public $timestamps = false;
	
	protected $fillable = [
		'razon_social',
		'nit',
		'telefono',
		'fax',
		'celular',
		'correo',
	    'sitio_web',
		'direccion',
		'fecha_registro',
		'rubro',
		'id_ciudad',
	];
	
	protected $guarded = [
	
	];
}
