<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
    protected $table = 'precio';
	protected $primaryKey = 'id_precio';
	public $timestamps = false;
	
	protected $fillable = [
		'precio_1',
		'precio_2',
		'precio_3',
		'precio_4',
		'precio_5',
		'id_articulo',
		'id_sucursal',
	];
	
	protected $guarded = [
	
	];
}
