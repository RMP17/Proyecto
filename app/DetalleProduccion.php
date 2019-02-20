<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class DetalleProduccion extends Model
{
    protected $table = 'detalle_produccion';
    protected $primaryKey = 'id_detalle_produccion';
    public $timestamps = false;

    protected $fillable = [
        'cantidad',
        'precio_unitario',
        'ancho',
        'largo',
        'id_articulo',
        'id_produccion',
    ];
    protected $guarded = [

    ];
}
