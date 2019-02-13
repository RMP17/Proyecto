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

    ];

    protected $guarded = [
        'id_empleado'
    ];

    public function medicionDetalle(){
        return $this->hasMany(MedicionDetalle::class,'id_medicion', 'id');
    }

    public static function newMedicion($parameters){
        $medicion = new Medicion();
        $medicion->fill($parameters);
        $medicion->id_empleado=\Auth::user()->id_empleado;
        $medicion->save();
        $medicion->medicionDetalle()->createMany($parameters['detalles']);
    }
    public static function getMedicionesByRangeDate($date1, $date2) {
        $mediciones = Medicion::whereBetween('fecha_visita', [$date1.' 00:00:00',$date2.' 23:59:59'])
            ->orderBy('fecha_visita', 'desc')->get();
        foreach ($mediciones as $medicion) {
            $medicion->empleado = Empleado::find($medicion->id_empleado)->nombre;
            $medicion->cliente = Cliente::find($medicion->id_cliente)->razon_social;
            $medicion->medicionDetalle;
        }
        return $mediciones;
    }
}
