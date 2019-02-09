<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursal';
	protected $primaryKey = 'id_sucursal';
	public $timestamps = false;
	
	protected $fillable = [
		'nombre',
		'casa_matriz',
		'direccion',
		'telefono',
		'fecha_apertura',
		'estatus',
		'id_ciudad',
		'id_empresa',
	];
	
	protected $guarded = [
	
	];
    public function empresa(){
        return $this->belongsTo(Empresa::class,'id_empresa');
    }
    public function ciudad(){
        return $this->belongsTo(Ciudad::class,'id_ciudad');
    }
    public function articulo(){
        return $this->belongsToMany(Articulo::class, 'articulos_sucursales','id_sucursal', 'id_articulo')
            ->withPivot('precio_1','precio_2','precio_3','precio_4','precio_5');
    }
    public static function updateSucursal($sucursal, $id_sucursal){

        $_sucusal = Sucursal::findOrFail($id_sucursal);
        $_sucusal->fill($sucursal);
        $_sucusal->update();
        Bitacora::insertInBitacora('UPDATE', $_sucusal);
        return true;
    }
}
