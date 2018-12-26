<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class CuentaProveedor extends Model
{
    protected $table = 'cuenta_proveedor';
	protected $primaryKey = 'id_cuenta';
	public $timestamps = false;
	
	protected $fillable = [
		'entidad',
		'nro_cuenta',
		'id_moneda',
		'id_proveedor'
	];
}
