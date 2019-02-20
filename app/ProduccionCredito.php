<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class ProduccionCredito extends Model
{
    protected $table = 'produccion_credito';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'monto',
        'observaciones',
        'id_produccion',
    ];
    protected $guarded = [
    ];

    public static function getCreditoOfProduccion($id_produccion){
        $_produccion= ProduccionCredito::where('id_produccion',$id_produccion)->get();
        return $_produccion;
    }
}
