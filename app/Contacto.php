<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'contacto';
	protected $primaryKey = 'id_contacto';
	public $timestamps = false;
	
	protected $fillable = [
		'nombre',
		'telefono',
		'interno',
		'celular',
		'correo',
		'fecha_registro',
		'estatus',
		'id_proveedor',
		'id_cargo'
	];
	
	protected $guarded = [
	
	];
}
