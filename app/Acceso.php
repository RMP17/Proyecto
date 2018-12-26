<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    protected $table = 'acceso';
	protected $primaryKey = 'id_empleado';
	public $timestamps = false;
	
	protected $fillable = [
		'usuario',
		'pass',
		'estatus',
	];
	
	protected $guarded = [
	
	];
}
