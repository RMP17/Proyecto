<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Produccion extends Model
{
    protected $table = 'produccion';
    protected $primaryKey = 'id_produccion';
    public $timestamps = false;

    protected $fillable = [
        'id_produccion',
        'observaciones',
        'tipo_pago',
        'fecha_inicio',
        'fecha_entrega',
        'id_cliente',
    ];
    protected $guarded = [
        'id_almacen',
        'id_caja',
        'costo_total',
        'id_empleado',
        // pr=en produccion; pc=produccion cancelada; pf=produccion finalizada
        'status',
    ];
}
