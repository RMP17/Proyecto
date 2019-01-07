<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Proveedor extends Model
{ 
    protected $table = 'proveedor';
	protected $primaryKey = 'id_proveedor';
	public $timestamps = false;
	
	protected $fillable = [
		'razon_social',
		'nit',
		'telefono',
		'fax',
		'celular',
		'correo',
	    'sitio_web',
		'direccion',
		'rubro',
		'id_ciudad',
	];
	
	protected $guarded = [
	
	];
    public function ciudad(){
        return $this->belongsTo(Ciudad::class,'id_ciudad');
    }
    public function cuentasProveedor(){
        return $this->hasMany(CuentaProveedor::class,'id_proveedor', 'id_proveedor');
    }
    public function contactos(){
        return $this->hasMany(Contacto::class,'id_proveedor', 'id_proveedor');
    }

    public function newProveedor($proveedor){
        $_proveedor = new Proveedor();
        $_proveedor->fill($proveedor);
        $_proveedor->fecha_registro = Carbon::now();
        $_proveedor->save();
        return true;
    }
    public function updateProveedor($proveedor, $id){
        $_proveedor = Proveedor::findOrFail($id);
        $_proveedor->fill($proveedor);
        $_proveedor->update();
        return true;
    }
    public function getProveedores(){
        $_proveedores = Proveedor::select('*')->orderBy('razon_social','asc')->get();
        foreach ($_proveedores as $proveedor) {
            $pias = null;
            if(!is_null($proveedor->ciudad)) {
                $pias = Ciudad::findOrFail($proveedor->ciudad->id_ciudad)->pais;
                $proveedor->ciudad->pais_ciudad=$pias->nombre.'-'.$proveedor->ciudad->nombre;
            }

            if (!is_null($proveedor->cuentasProveedor)) {
                foreach ($proveedor->cuentasProveedor as $cuentaProveedor) {
                    if (!is_null($cuentaProveedor->id_moneda)) {
                        $_cuentaProveedor = CuentaProveedor::findOrFail($cuentaProveedor->id_cuenta)->moneda;
                        $cuentaProveedor->moneda = $_cuentaProveedor->nombre . ' - ' .$_cuentaProveedor->codigo;
                    } else {
                        $cuentaProveedor->moneda = null;
                    }
                }
            }
        }
        return $_proveedores;
    }
    public static function suggestionsProveedor($query){
        $proveedores = Proveedor::where('razon_social', 'like','%'.$query.'%')->orderBy('razon_social','desc')->take(10)->get();
        return $proveedores;
    }
    public static function getContactosOfProveedor($id_proveedor){
        $_proveedor = Proveedor::findOrFail($id_proveedor);

        $contactos = $_proveedor->contactos;

        foreach ($contactos as $contacto) {
            $contacto->proveedor = [
                'id_proveedor' =>$_proveedor->id_proveedor,
                'razon_social' =>$_proveedor->razon_social,
                ];
            $contacto->cargo = Cargo::find($contacto->id_cargo);
        }

        return $_proveedor->contactos;
    }
}
