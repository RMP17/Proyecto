<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
	protected $table = 'empresa';
	protected $primaryKey = 'id_empresa';
	public $timestamps = false;
	
	protected $fillable = [
		'razon_social',
		'nit',
		'propietario',
		'actividad',
	];
	
	protected $guarded = [
	
	];
}
