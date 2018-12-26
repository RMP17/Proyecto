<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = 'almacen';
	protected $primaryKey = 'id_almacen';
	public $timestamps = false;
	
	protected $fillable = [
		'codigo',
		'direccion',
		'id_sucursal',
	];
	
	protected $guarded = [
	
	];
}
