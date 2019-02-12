<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class MovimientoAlmacen extends Model
{
    protected $table = 'movimientos_almacenes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'observaciones',
        'id_almacen_origen',
        'id_almacen_destino'
    ];

    protected $guarded = [
        'id_empleado'
    ];
}
