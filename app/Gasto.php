<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Gasto extends Model
{
    protected $table = 'gasto';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'monto',
        'descripcion',
    ];

    protected $guarded = [
        'fecha',
        'id_caja',
        'id_empleado',
    ];
    public function caja(){
        return $this->belongsTo(Caja::class,'id_caja');
    }

    public static function newGasto($parameters)
    {
        /*if()*/
        $caja = Caja::where('id_empleado', auth()->user()->id_empleado)->first();
        if (!is_null($caja) && !is_null($caja->id_empleado)) {
            if ($caja->status != 'a') {
                return [
                    'messages' => [
                        'errors' => [
                            'caja'=>['Debe aperturar la caja']
                        ]
                    ],
                    'code' => 400
                ];
            }
            $gasto = new Gasto();
            $gasto->fill($parameters);
            $gasto->fecha = Carbon::now();
            $gasto->id_caja = $caja->id_caja;
            $gasto->id_empleado = $caja->id_empleado;
            $gasto->save();
            return [
                'message' => [],
                'code' => 200
            ];
        } else {
            return [
                'message' => [
                    'errors' => [
                        'caja' => ['No está asignado a ninguna caja']
                    ]
                ],
                'code' => 400
            ];
        }
    }
    public static function getGastoByRangeDate($date1, $date2) {
        $gastos = Gasto::whereBetween('fecha', [$date1.' 00:00:00',$date2.' 23:59:59'])
            ->orderBy('fecha', 'desc')->get();
        foreach ($gastos as $gasto) {
            $caja=$gasto->caja;
            unset($gasto->caja);
            $gasto->caja= $caja->nombre;
            $gasto->empleado=Empleado::find($gasto->id_empleado)->nombre;
        }
        return $gastos;
    }
}