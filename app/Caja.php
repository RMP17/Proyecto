<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
   protected $table = 'caja';
   protected $primaryKey = 'id_caja';
   public $timestamps = false;
	
	protected $fillable = [
		'nombre',
		'estatus',
		'id_empleado',
		'id_sucursal',
	];
	protected $guarded = [
	
	];
}
