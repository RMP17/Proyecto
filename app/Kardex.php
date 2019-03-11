<?php

namespace Allison;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kardex extends Model
{

    protected $table = 'kardex';
    protected $primaryKey = 'id_kardex';
    public $timestamps = false;

    protected $fillable = [
        'fecha_inicio',
        'id_empleado',
        'id_cargo',
        //'id_tipo_empleado',
    ];

    protected $guarded = [
        'fecha_baja',
        'fecha_registro',
    ];

    public function salario()
    {
        return $this->hasOne(Salario::class, 'id_kardex', 'id_kardex');
    }

    public function kardexObservaciones()
    {
        return $this->hasMany(KardexObservaciones::class, 'id_kardex', 'id_kardex');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'id_cargo');
    }

    public static function getKardexEmpleado($id_empleado)
    {
        $kardex = Kardex::where('id_empleado', $id_empleado)->orderBy('id_kardex', 'desc')->get();
        foreach ($kardex as $_kardex) {
            $_kardex->kardexObservaciones;
            $_kardex->cargo;
            $salario = $_kardex->salario;
            /*if(!is_null($salario)) {
                $_kardex->salario->simbolo = Moneda::find($salario->id_moneda)->codigo;
            } else {
                $_kardex->salario = null;
            }*/
        }
        return $kardex;
    }

    public static function newKardex($parameters)
    {
        DB::beginTransaction();
        try {
            $_kardex = Kardex::where('id_empleado', $parameters['id_empleado'])->orderBy('id_kardex', 'desc')->lockForUpdate()->first();
            if ($_kardex && is_null($_kardex->fecha_baja)) {
                $_kardex->fecha_baja = Carbon::now()->toDateString();
                $_kardex->update();
            }

            $kardex = new kardex();
            $kardex->fill($parameters);
            $kardex->fecha_registro=Carbon::now()->toDateString();
            $kardex->save();
            $salario = new Salario();
            $salario->monto = $parameters['salario'];
            $kardex->salario()->save($salario);

            $acceso = Acceso::find($parameters['id_empleado']);
            $acceso->estatus = 1;
            $acceso->update();
            $empleado= Empleado::find($parameters['id_empleado']);
            $empleado->estatus = 1;
            $empleado->update();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'message' => [
                    'errors' => [
                        'error' => [
                            'Algo salio mal en la venta'
                        ]
                    ]
                ],
                'code' => 400
            ];
        }
    }
    public static function updateKardex($parameters)
    {
        DB::beginTransaction();
        try {
            $kardex = kardex::find($parameters['id_kardex']);
            $kardex->fill($parameters);
            $kardex->update();
            $salario = Salario::find($parameters['id_kardex']);
            $salario->monto = $parameters['salario'];
            $salario->update();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'message' => [
                    'errors' => [
                        'error' => [
                            'Algo salio mal en la venta'
                        ]
                    ]
                ],
                'code' => 400
            ];
        }
    }

}
