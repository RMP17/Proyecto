<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class MovimientoAlmacenDetalle extends Model
{
    protected $table = 'movimientos_almacen_detalle';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_articulo',
        'cantidad',
    ];

    protected $guarded = [
        'id_movimiento_almacen'
    ];
}
