<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
	
    protected $table = 'detalle_venta';
	protected $primaryKey = 'id_detalle_venta';
	public $timestamps = false;
	
	protected $fillable = [
		'cantidad',
        'precio_unitario',
		'id_articulo',
		'id_almacen',
		'id_venta',
	];
	
	protected $guarded = [
	
	];
	
}
