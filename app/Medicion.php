<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Medicion extends Model
{
    protected $table = 'mediciones';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'fecha_visita',
        'direccion',
        'descripcion_direccion',
        'observaciones',
        'id_cliente',
        'id_empleado'
    ];

    protected $guarded = [

    ];
}
