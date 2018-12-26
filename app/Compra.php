<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compra';
	protected $primaryKey = 'id_compra';
	public $timestamps = false;
	
	protected $fillable = [
		'fecha',
		'descuento',
		'costo_total',
		'codigo_tarjeta_cheque',
		'observaciones',
		'estatus',
		'nro_factura',
		'id_moneda',
		'id_empleado',
		'id_contacto',
		'id_tipo_pago'
	];
}
