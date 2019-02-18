<?php

namespace Allison;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = 'caja';
    protected $primaryKey = 'id_caja';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'id_empleado',
    ];
    protected $guarded = [
        // a=abierto; c=cerrado;
        'estatus',
    ];

    public function cajaChica()
    {
        return $this->hasMany(CajaChica::class, 'id_caja', 'id_caja');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

    public static function newCaja($parameters){
        $caja = new Caja();
        $caja->fill($parameters);
        $caja->save();
        Bitacora::insertInBitacora('CREATE', $parameters);
    }

    public static function updateCaja($parameters){
        $caja = Caja::find($parameters['id_caja']);
        Bitacora::insertInBitacora('UPDATE', $caja);
        $caja->fill($parameters);
        $caja->update();
    }

    public static function getCajas()
    {
        $cajas = Caja::select('*')->orderBy('nombre')->get();
        foreach ($cajas as $caja) {
            $empleado = [
                'nombre' => $caja->empleado->nombre,
                'id_empelado' => $caja->empleado->id_empleado
            ];
            unset($caja->empleado);
            $caja->empleado = $empleado;
        }
        return $cajas;
    }

    public static function simpleSuggestionsCajas($query)
    {
        $cajas = Caja::select('nombre', 'id_caja')->where('nombre', 'like', '%' . $query . '%')->orderBy('nombre', 'desc')->take(10)->get();
        return $cajas;
    }

    public static function getCaja()
    {
        $cajas = Caja::where('id_empleado', auth()->user()->id_empleado)->first();
        if (!is_null($cajas)) {
            return $cajas;
        } else {
            return [
                'messages' => [
                    'caja' => ['El empleado no esta asignado a niguna caja']
                ],
                'code' => 400
            ];
        }
    }

    public static function getSummary()
    {
        $date1 = Carbon::now()->format('Y-m-d');
        $caja = Caja::where('id_empleado', auth()->user()->id_empleado)->first();
        $resumenCaja = [
            'caja' => '',
            'ventas_total' => 0,
            'ventas_credito_monto_pagado_total' => 0,
            'ventas_credito_total' => 0,
            'gastos_total' => 0,
            'monto_apertura' => 0
        ];
        if (!is_null($caja)) {
            $ventaTotal = Venta::whereBetween('fecha', [$date1 . ' 00:00:00', $date1 . ' 23:59:59'])
                ->where('id_caja', $caja->id_caja)
                ->where(function ($query) {
                    $query->where('estatus', '=', null)
                        ->orWhere('estatus', '=', 'cc');
                })->sum('costo_total');

            $ventasCreditoMontoPagadoTotal = Venta::where('venta.id_caja', $caja->id_caja)
                ->where(function ($query) {
                    $query->where('venta.estatus', '=', 'cv');
                })->join('venta_credito', 'venta.id_venta', '=', 'venta_credito.id_venta')
                ->whereBetween('venta_credito.fecha', [$date1 . ' 00:00:00', $date1 . ' 23:59:59'])
                ->sum('venta_credito.monto');
            $ventasCreditoTotal = Venta::where('id_caja', $caja->id_caja)
                ->where('estatus', '=', 'cv')
                ->whereBetween('fecha', [$date1 . ' 00:00:00', $date1 . ' 23:59:59'])
                ->sum('costo_total');
            $montoApertura = CajaChica::where('id_caja', $caja->id_caja)
                ->whereBetween('fecha_apertura', [$date1 . ' 00:00:00', $date1 . ' 23:59:59'])
                ->sum('monto_apertura');
            $gastosTotal = Gasto::where('id_caja', $caja->id_caja)
                ->whereBetween('fecha', [$date1 . ' 00:00:00', $date1 . ' 23:59:59'])
                ->sum('monto');

            $resumenCaja = [
                'caja' => $caja->nombre,
                'ventas_total' => (float)$ventaTotal,
                'ventas_credito_monto_pagado_total' => (float)$ventasCreditoMontoPagadoTotal,
                'ventas_credito_total' => (float)$ventasCreditoTotal,
                'gastos_total' => (float)$gastosTotal,
                'monto_apertura' => (float)$montoApertura
            ];
        }
        return $resumenCaja;
    }

    public static function closedAndOpenCashier($parameters)
    {
        $caja = Caja::where('id_empleado', auth()->user()->id_empleado)->first();
        if (!is_null($caja)) {
            if (is_null($caja->status) || $caja->status == 'c') {
                $cajaChica = new CajaChica();
                $cajaChica->monto_apertura = $parameters['monto'];
                $cajaChica->fecha_apertura = Carbon::now();
                $caja->cajaChica()->save($cajaChica);
                $caja->status = 'a';
                $caja->update();
            } else if ($caja->status == 'a') {
                $cajaChica = CajaChica::where('fecha_cierre', null)->first();
                $cajaChica->monto_declarado = $parameters['monto'];
                $cajaChica->diferencia = $parameters['diferencia'];
                $cajaChica->observaciones = $parameters['observaciones'];
                $cajaChica->fecha_cierre = Carbon::now();
                $cajaChica->update();
                $caja->status = 'c';
                $caja->update();
            }
            return null;
        }
        return [
            'messages' => [
                'caja' => ['El empleado no esta asignado a niguna caja']
            ],
            'code' => 400
        ];
    }

    /**
     * insert in bitacora
     *
     * @param  string $action
     * @param  string $descripcion
     * @void
     */
}
