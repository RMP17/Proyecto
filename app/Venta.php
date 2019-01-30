<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Venta extends Model
{
	
    protected $table = 'venta';
	protected $primaryKey = 'id_venta';
	public $timestamps = false;
	
	protected $fillable = [
		'fecha',
		'costo_total',
		'costo_tarjeta_cheque',
		'descuento',
		'estatus',
		'id_moneda',
		'id_cliente',
		'tipo_pago',
	];
	
	protected $guarded = [
        'id_caja',
	];
    public function detallesVenta(){
        return $this->hasMany(DetalleVenta::class,'id_venta', 'id_venta');
    }
	public static function newVenta($parameters){
        DB::beginTransaction();
        try {
            $parameters['descuento'] = !is_null($parameters['descuento']) ? $parameters['descuento'] : 0;
            if (!$parameters['id_cliente']) {
                $cliente = Cliente::where('razon_social', 'S/N')->first();
                if (is_null($cliente)) {
                    $cliente = new Cliente();
                    $cliente->razon_social = 'S/N';
                    $cliente->nit = 0;
                    $cliente->save();
                }
                $parameters['id_cliente'] = $cliente->id_cliente;
            }
            $empleado = Empleado::find(auth()->user()->id_empleado);
            $_venta = new Venta();
            $_venta->fill($parameters);
            $_venta->fecha = Carbon::now();
            $caja = Caja::where('id_empleado', $empleado->id_empleado)->first();
            if (is_null($caja)) {
                return ['message' => 'No está asignado a ninguna caja', 'code' => 400];
            }
            $_venta->id_caja = $caja->id_caja;
            $_venta->costo_total = self::calcularTotal($parameters['detalles_venta']);
            if ($_venta->costo_total < $parameters['descuento']) {
                return [
                    'message' => [
                        'errors' => [
                            'cotos_total' => [
                                'Descuento debe ser menor al total'
                            ]
                        ]
                    ],
                    'code' => 400
                ];
            }
            // Status
            // cc: credito cancelado; cv: credito vigente y null significa que no existe credito

            // Tipo de pago trabaja con estos valores:
            // ef=Efectivo; cr=al credito; ch=cheque; tc=Tarjeta de crédito o débito.
            if ($parameters['tipo_pago'] == 'cr') {
                $_venta->estatus = 'cv';
            }
            $_venta->id_caja;
            $_venta->save();
            $_venta->detallesVenta()->createMany($parameters['detalles_venta']);

//        todo: preguntar si solo se manejara un solo almacen por sucursal
            $almacen = Almacen::where('id_sucursal', $empleado->id_sucursal)->first();
            foreach ($parameters['detalles_venta'] as $detalle) {
                $productoInsuficiente = Articulo::find($detalle['id_articulo'])->nombre;
                $stock = Stock::where('id_articulo', $detalle['id_articulo'])
                    ->where('id_almacen', $almacen->id_almacen)->lockForUpdate()->first();
                if (!is_null($stock)) {
                    if ($stock->cantidad - $detalle['cantidad'] < 0) {
                        DB::rollback();
                        return [
                            'message' => [
                                'errors' => [
                                    'stock' => [
                                        'Stock insuficiente del articulo ' . $productoInsuficiente
                                    ]
                                ]
                            ],
                            'code' => 400
                        ];
                    }
                    $stock->cantidad -= (int)$detalle['cantidad'];
                    $stock->update();
                } else {
                    return [
                        'message' => [
                            'errors' => [
                                'stock' => [
                                    'El articulo no existe en este almacen ' . $productoInsuficiente
                                ]
                            ]
                        ],
                        'code' => 400
                    ];
                }
            }
            DB::commit();
            return null;
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
    private static function calcularTotal(&$detallesVenta){
        $costo_total=0;
        foreach ($detallesVenta as &$detalle) {
            $subtotal = $detalle['cantidad'] * $detalle['precio_unitario'];
            $detalle['subtotal'] = $subtotal+1000;
            $costo_total+= $subtotal;
        }
        return $costo_total;
    }
	
}
