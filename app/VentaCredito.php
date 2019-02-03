<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VentaCredito extends Model
{
    protected $table = 'venta_credito';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'monto',
        'tipo_pago',
        'observaciones',
    ];

    protected $guarded = [
        'id_venta'
    ];
    public function venta(){
        return $this->belongsTo(Venta::class,'id_venta');
    }
    public static function newVentaCredito($parameters){
        $_venta= Venta::find($parameters['id_venta']);
        if($_venta->estatus=='cv') {
            $venta_credito_total = VentaCredito::where('id_venta', $parameters['id_venta'])->sum('monto');
            if ($venta_credito_total > $_venta->costo_total) {
                return false;
            }
            $venta_credito = new VentaCredito();
            $venta_credito->fill($parameters);
            if ($venta_credito_total + $parameters['monto'] <= $_venta->costo_total) {
                $venta_credito->monto = $parameters['monto'];
            } else {
                $venta_credito->monto = $_venta->costo_total - $venta_credito_total;
                if ($venta_credito->monto == 0) {
                    return false;
                }
                $_venta->estatus = 'cc';
                $_venta->update();
            }
            if ($venta_credito->monto + $venta_credito_total - $_venta->costo_total == 0) {
                $_venta->estatus = 'cc';
                $_venta->update();
            }

            $venta_credito->fecha = Carbon::now();
            $_venta->ventaCredito()->save($venta_credito);
        }
        return true;
    }
    public static function getCreditoVenta($id_venta){
        $_venta= VentaCredito::where('id_venta',$id_venta)->get();
        return $_venta;
    }
}
