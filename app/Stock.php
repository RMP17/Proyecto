<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock';
	protected $primaryKey = 'id_stock';
	public $timestamps = false;
	
	protected $fillable = [
		'id_articulo',
		'id_almacen',
		'cantidad',
	];
	
	protected $guarded = [
	
	];
}
