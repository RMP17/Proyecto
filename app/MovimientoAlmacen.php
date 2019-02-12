<?php

namespace Allison;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MovimientoAlmacen extends Model
{
    protected $table = 'movimientos_almacen';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'observaciones',
        'id_almacen_origen',
        'id_almacen_destino'
    ];

    protected $guarded = [
        'id_empleado',
        // Status trabaja con estos valores:
        // mc=movimiento cancelado.
        'status'
    ];

    public function movimientosAlmacenDetalle(){
        return $this->hasMany(MovimientoAlmacenDetalle::class,'id_movimiento_almacen', 'id');
    }


    public static function newMovimientoAlmacen($parameters){
        $movimiento_almacen = new MovimientoAlmacen();
        $movimiento_almacen->fill($parameters);
        $movimiento_almacen->fecha=Carbon::now()->toDateTimeString();
        $movimiento_almacen->id_empleado=\Auth::user()->id_empleado;
        $movimiento_almacen->save();
        $movimiento_almacen->movimientosAlmacenDetalle()->createMany($parameters['detalles']);
    }
    public static function getMovimientoAlmacenByRangeDate($date1, $date2) {
        $movimientosAlmacen = MovimientoAlmacen::whereBetween('fecha', [$date1.' 00:00:00',$date2.' 23:59:59'])
            ->orderBy('fecha', 'desc')->get();
        foreach ($movimientosAlmacen as $movimiento) {
            $movimiento->empleado = Empleado::find($movimiento->id_empleado)->nombre;
            $movimiento->almacen_origen = Almacen::find($movimiento->id_almacen_origen)->codigo;
            $movimiento->almacen_destino = Almacen::find($movimiento->id_almacen_destino)->codigo;
            foreach ($movimiento->movimientosAlmacenDetalle as $detalle){
                $detalle->articulo = Articulo::find($detalle->id_articulo)->nombre;
            }
        }
        return $movimientosAlmacen;
    }
    public static function cancelMovimientoAlmacen($id_movimiento_almacen) {
        $movimientoAlmacen = MovimientoAlmacen::find($id_movimiento_almacen);
        Bitacora::insertInBitacora('DELETE', $movimientoAlmacen);
        $movimientoAlmacen->status='mc';
        $movimientoAlmacen->update();
        /*$venta->detallesVenta;
        foreach ($venta->detallesVenta as $detalle) {
            $stock = Stock::where('id_articulo', $detalle['id_articulo'])
                ->where('id_almacen', $venta->id_almacen)->lockForUpdate()->first();
            if (!is_null($stock)) {
                $stock->cantidad = $stock->cantidad +(int)$detalle['cantidad'];
                $stock->update();
            }
        }
        $venta->update();*/
    }
}
