<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class ProduccionEntrega extends Model
{
    protected $table = 'produccion_entrega';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_empleado',
        'id_articulo',
        'cantidad',
    ];

    protected $guarded = [
        'id_almacen',
        'fecha',
    ];
}
