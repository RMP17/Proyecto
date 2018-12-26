<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursal';
	protected $primaryKey = 'id_sucursal';
	public $timestamps = false;
	
	protected $fillable = [
		'nombre',
		'casa_matriz',
		'direccion',
		'telefono',
		'fecha_apertura',
		'estatus',
		'id_ciudad',
		'id_empresa',
	];
	
	protected $guarded = [
	
	];
}
