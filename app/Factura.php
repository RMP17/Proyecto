<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
	
    protected $table = 'factura';
	protected $primaryKey = 'id_factura';
	public $timestamps = false;
	
	protected $fillable = [
		'fecha',
		'codigo_control',
		'codigo_qr',
		'nro_factura',
		'nit',
		'importe_credito_fiscal',
		'observaciones',
		'id_dosificacion',
		'id_venta',
	];
	
	protected $guarded = [
	
	];
	
}
