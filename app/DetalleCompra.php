<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    protected $table = 'detalle_compra';
    protected $primaryKey = 'id_detalle_compra';
    public $timestamps = false;

    protected $fillable = [
        'cantidad',
        'precio_unitario',
        'id_articulo',
        'id_almacen',
    ];
}
