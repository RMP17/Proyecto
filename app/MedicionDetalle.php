<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class MedicionDetalle extends Model
{
    protected $table = 'mediciones_detalle';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
        'ancho',
        'alto',
        'cantidad',
        'ubicacion',
        'id_medicion'
    ];

    protected $guarded = [];
    
}
