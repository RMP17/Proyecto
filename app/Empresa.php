<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
	protected $table = 'empresa';
	protected $primaryKey = 'id_empresa';
	public $timestamps = false;
	
	protected $fillable = [
		'razon_social',
		'nit',
		'propietario',
		'actividad',
	];
	
	protected $guarded = [
	
	];
    public function sucursales(){
        return $this->hasMany(Sucursal::class,'id_empresa','id_empresa');
    }

    public static function newEmpresa($parameters_empresa){
        $_empresa = new Empresa();
        $_empresa->fill($parameters_empresa);
        $_empresa->save();
        return true;
    }
    public static function updateEmpresa($empresa, $id_empresa){
        $_empresa = Empresa::findOrFail($id_empresa);
        $_empresa->fill($empresa);
        $_empresa->update();
        return true;
    }
    public static function addSucursalToEmpresa($parameters_sucursal, $id_empresa){
        $_empresa = Empresa::findOrFail($id_empresa);
        $sucursal = new Sucursal();
        $sucursal->fill($parameters_sucursal);
        $_empresa->sucursales()->save($sucursal);
        return true;
    }
    public static function getEmpresas(){
        $empresa = Empresa::select('*')->orderBy('razon_social', 'asc')->get();
        foreach ($empresa as $empres) {
            if (!is_null($empres->sucursales)) {
                $empres->sucursales;
                foreach ($empres->sucursales as $sucursal) {
                    $pias = null;
                    if(!is_null($sucursal->ciudad)) {
                        $pias = Ciudad::findOrFail($sucursal->ciudad->id_ciudad)->pais;
                        $sucursal->ciudad->pais_ciudad=$pias->nombre.'-'.$sucursal->ciudad->nombre;
                    }
                }
            } else {
                $empres->sucursales = null;
            }
        }
        return $empresa;
    }
}
