<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
	
    protected $table = 'venta';
	protected $primaryKey = 'id_venta';
	public $timestamps = false;
	
	protected $fillable = [
		'fecha',
		'costo_total',
		'costo_tarjeta_cheque',
		'descuento',
		'estatus',
		'id_moneda',
		'id_cliente',
		'id_caja',
		'id_tipo_pago',
	];
	
	protected $guarded = [
	
	];
	
}
