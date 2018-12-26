<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Dosificacion extends Model
{
	
    protected $table = 'dosificacion';
	protected $primaryKey = 'id_dosificacion';
	public $timestamps = false;
	
	protected $fillable = [
		'nro_autorizacion',
		'fecha_limite_emision',
		'nro_inicial',
		'nro_final',
		'llave',
		'leyenda',
		'estatus',
		'fecha_registro',
	];
	
	protected $guarded = [
	
	];
	
}
