<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = 'almacen';
	protected $primaryKey = 'id_almacen';
	public $timestamps = false;
	
	protected $fillable = [
		'codigo',
		'direccion',
		'id_sucursal',
	];
	
	protected $guarded = [
	
	];
    public function sucursal(){
        return $this->belongsTo(Sucursal::class,'id_sucursal');
    }

	public static function getAlmacenes() {
	    $almacenes= Almacen::select('*')->orderBy('codigo', 'asc')->get();
	    foreach ($almacenes as $almacene) {
            $almacene->sucursal;
        }
	    return $almacenes;
    }
    public static function addAlmacen($parameters_almacen) {
        $_almacen = new Almacen();
        $_almacen->fill($parameters_almacen);
        $_almacen->save();
        Bitacora::insertInBitacora('UPDATE', $_almacen);
        return true;
    }
    public static function updateAlmacen($almacen, $id_almacen){
        $_almacen = Almacen::findOrFail($id_almacen);
        $_almacen->fill($almacen);
        $_almacen->update();
        return true;
    }
}
