<?php

namespace Allison;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EntradaSalidaArticulo extends Model
{
    protected $table = 'entradas_salidas_articulos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_almacen',
        'id_articulo',
        'cantidad',
        'actividad',
        'observaciones',
    ];

    protected $guarded = [
        'id_empleado',
        'fecha'
    ];
    public function empleado(){
        return $this->belongsTo(Empleado::class,'id_empleado')->withDefault();
    }
    public function almacen(){
        return $this->belongsTo(Almacen::class,'id_almacen')->withDefault();
    }
    public function articulo(){
        return $this->belongsTo(Articulo::class,'id_articulo')->withDefault();
    }

    public static function newEntradaSalidaArticulo($parameters)
    {
        DB::beginTransaction();
        try {
            $entrada_salida_articulo = new EntradaSalidaArticulo();
            $entrada_salida_articulo->fill($parameters);
            $entrada_salida_articulo->id_empleado = auth()->user()->id_empleado;
            $entrada_salida_articulo->fecha = Carbon::now()->toDateTimeString();
            $entrada_salida_articulo->save();
            $stock = Stock::where('id_articulo', $parameters['id_articulo'])
                ->where('id_almacen', $parameters['id_almacen'])->lockForUpdate()->first();
            if ($parameters['actividad'] == 's')
                $stock->cantidad = $stock->cantidad - $parameters['cantidad'];
            else
                $stock->cantidad = $stock->cantidad + $parameters['cantidad'];
            $stock->update();
            DB::commit();
            return [
                'message' => [],
                'code' => 200
            ];
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
    public static function getEntradaSalidaByRangeDate($date1, $date2) {

        $entradasSalidas = EntradaSalidaArticulo::whereBetween('fecha', [$date1.' 00:00:00',$date2.' 23:59:59'])
            ->orderBy('id', 'desc')->get();
        foreach ($entradasSalidas as $entradaSalida) {
            $empleado = $entradaSalida->empleado->nombre;
            $almacen = $entradaSalida->almacen;
            $articulo = $entradaSalida->articulo;
            unset($entradaSalida->empleado);
            unset($entradaSalida->almacen);
            unset($entradaSalida->articulo);
            $entradaSalida->empleado = $empleado;
            $entradaSalida->almacen= $almacen->codigo;
            $entradaSalida->articulo= $articulo->nombre;
        }
        return $entradasSalidas;
    }
}
