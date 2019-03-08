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
        'ancho',
        'largo',
        'precio_unitario',
		'id_articulo',
		'id_venta',
	];
	
	protected $guarded = [
	
	];
    public function venta(){
        return $this->belongsTo(Venta::class,'id_venta');
    }
}
