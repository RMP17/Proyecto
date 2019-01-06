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
    public function proveedor(){
        return $this->belongsTo(Proveedor::class,'id_proveedor');
    }
    public function moneda(){
        return $this->belongsTo(Moneda::class,'id_moneda');
    }
    public function newCuenta($parameters_cuenta) {
        $proveedor = Proveedor::findOrFail($parameters_cuenta['id_proveedor']);

        if(!is_null($proveedor)) {
            $cuentaProveedor = new CuentaProveedor();
            $cuentaProveedor->fill($parameters_cuenta);
            $proveedor->cuentasProveedor()->save($cuentaProveedor);
            return true;
        }
        return false;
    }
}
