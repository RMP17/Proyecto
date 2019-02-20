<?php

namespace Allison;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produccion extends Model
{
    protected $table = 'produccion';
    protected $primaryKey = 'id_produccion';
    public $timestamps = false;

    protected $fillable = [
        'id_produccion',
        'observaciones',
        // Tipo de pago trabaja con estos valores:
        // ef=Efectivo; cr=al credito; co=cotizacion; ch=cheque; tc=Tarjeta de crédito o débito.
        'tipo_pago',
        'fecha_inicio',
        'fecha_entrega',
        'id_cliente',
    ];
    protected $guarded = [
        'id_almacen',
        'id_caja',
        'costo_total',
        'id_empleado',
        // pr=en produccion; pc=produccion cancelada; pf=produccion finalizada
        'status',
    ];
    public function detallesProduccion(){
        return $this->hasMany(DetalleProduccion::class,'id_produccion', 'id_produccion');
    }
    public function cliente(){
        return $this->belongsTo(Cliente::class,'id_cliente');
    }
    public function empleado(){
        return $this->belongsTo(Empleado::class,'id_empleado')->withDefault();
    }
    public function moneda(){
        return $this->belongsTo(Moneda::class,'id_moneda');
    }
    public function almacen(){
        return $this->belongsTo(Almacen::class,'id_almacen');
    }
    public function caja(){
        return $this->belongsTo(Caja::class,'id_caja');
    }
    public function produccionCredito(){
        return $this->hasMany(ProduccionCredito::class,'id_produccion','id_produccion');
    }
    public static function newProduccion($parameters){
        DB::beginTransaction();
        try {
            /*$parameters['descuento'] = !is_null($parameters['descuento']) ? $parameters['descuento'] : 0;*/
            $empleado = Empleado::find(auth()->user()->id_empleado);
            $caja = Caja::where('id_empleado', $empleado->id_empleado)->first();
            if (is_null($caja)) {
                return [
                    'message' => [
                        'caja'=>['No está asignado a ninguna caja']
                    ],
                    'code' => 400
                ];
            }
            foreach ($parameters['detalles'] as $detalle) {
                if( ($detalle['ancho'] && !$detalle['largo']) || (!$detalle['ancho'] && $detalle['largo'])){
                    return [
                        'message' => [
                            'errors' => [
                                'medidas' => [
                                    'Las medidas no estan correctas'
                                ]
                            ]
                        ],
                        'code' => 400
                    ];
                }
            }

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
            $_produccion = new Produccion();
            $_produccion->fill($parameters);
            $_produccion->id_empleado=$empleado->id_empleado;
            $_produccion->id_almacen=$empleado->id_almacen;
//            $_produccion->fecha = Carbon::now()->toDateTimeString();
            $_produccion->id_caja = $caja->id_caja;
            foreach ($parameters['detalles'] as $detalle) {
                $precios= DB::table('articulos_sucursales')
                    ->where('id_articulo',$detalle['id_articulo'])
                    ->where('id_sucursal', $detalle['id_sucursal'])->first();

                if ( !($precios->precio_1==$detalle['precio_unitario']
                    || $precios->precio_2==$detalle['precio_unitario']
                    || $precios->precio_3==$detalle['precio_unitario']
                    || $precios->precio_4==$detalle['precio_unitario']
                    || $precios->precio_5==$detalle['precio_unitario'])
                ){
                    return [
                        'message' => [
                            'errors' => [
                                'precio' => [
                                    'precios no encontrados'
                                ]
                            ]
                        ],
                        'code' => 400
                    ];
                }
            }
            $_produccion->costo_total = self::calcularTotal($parameters['detalles']);
            if(in_array($parameters['tipo_pago'], ['ef','tc','ch'])){
                if(is_null($parameters['importe']) || $parameters['importe'] == 0 ){
                    $parameters['importe'] = $_produccion->costo_total;
                } else if( $parameters['importe'] < $_produccion->costo_total ){
                    return [
                        'message' => [
                            'errors' => [
                                'importe' => [
                                    'Importe debe ser igual o mayor al total por pagar'
                                ]
                            ]
                        ],
                        'code' => 400
                    ];
                }
            } else if ($parameters['tipo_pago'] == 'cr') {
                $_produccion->status = 'cv';
            }

            /*if ($_produccion->costo_total < $parameters['descuento']) {
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
            }*/
            // Status
            // cc: credito cancelado; cv: credito vigente y null significa que no existe credito

            // Tipo de pago trabaja con estos valores:
            // ef=Efectivo; cr=al credito; ch=cheque; tc=Tarjeta de crédito o débito.

            $_produccion->id_caja;
            $_produccion->save();
            $_produccion->detallesProduccion()->createMany($parameters['detalles']);

            if ($parameters['tipo_pago'] == 'cr' && $parameters['importe'] && $parameters['importe']>0) {

                if($parameters['importe']>=$_produccion->costo_total){
                    return [
                        'message' => [
                            'errors' => [
                                'importe' => [
                                    'El importe supera al total de la produccion al crédito, cambie a produccion en efectivo'
                                ]
                            ]
                        ],
                        'code' => 400
                    ];
                }
                $produccion_credito=new ProduccionCredito();
                $produccion_credito->fecha= Carbon::now()->toDateTimeString();
                $produccion_credito->monto= $parameters['importe'];
                $produccion_credito->observaciones= 'monto inicial';
                $produccion_credito->id_produccion= $_produccion->id_produccion;
                $_produccion->produccionCredito()->save($produccion_credito);
            }

            foreach ($parameters['detalles'] as $detalle) {
                if(!($detalle['ancho'] && $detalle['largo'])) {
                    $productoInsuficiente = Articulo::find($detalle['id_articulo'])->nombre;
                    $stock = Stock::where('id_articulo', $detalle['id_articulo'])
                        ->where('id_almacen', $empleado->id_almacen)->lockForUpdate()->first();
                    if (!is_null($stock)) {
                        /*if ($stock->cantidad - $detalle['cantidad'] < 0) {
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
                        }*/
                        $stock->cantidad = $stock->cantidad -(int)$detalle['cantidad'];
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

            }
            DB::commit();
            $cliente = $_produccion->cliente;
            $empleado = $_produccion->empleado;
            $caja = $_produccion->caja;
            $almacen = $_produccion->almacen;
            $sucursal = Sucursal::find($almacen->id_sucursal);
            unset($_produccion->cliente);
            unset($_produccion->empleado);
            unset($_produccion->caja);
            unset($_produccion->almacen);
            $sucursal->empresa;
            $_produccion->cliente = ['razon_social'=>$cliente->razon_social,'nit'=>$cliente->nit];
            $_produccion->empleado = $empleado->nombre;
            $_produccion->caja = $caja->nombre;
            $_produccion->almacen = $almacen;
            $_produccion->sucursal = $sucursal;
            $_produccion->detallesProduccion;
            foreach ($_produccion->detallesProduccion as $detalle) {
                $detalle->articulo = Articulo::find($detalle->id_articulo)->nombre;
            }
            return [
                'data' => $_produccion,
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
    private static function calcularTotal(&$detallesVenta){
        $costo_total=0;
        foreach ($detallesVenta as &$detalle) {
            $subtotal = $detalle['cantidad'] * $detalle['precio_unitario'];
            $detalle['subtotal'] = $subtotal+1000;
            $costo_total+= $subtotal;
        }
        return $costo_total;
    }
    public static function getProduccionesByRangeDate($date1, $date2) {

        $_producciones = Produccion::whereBetween('fecha_inicio', [$date1.' 00:00:00',$date2.' 23:59:59'])
            ->orderBy('fecha_inicio', 'desc')->get();
        foreach ($_producciones as $_produccion) {
            $empleado = $_produccion->empleado->nombre;
            $caja = $_produccion->caja->nombre;
            $almacen = $_produccion->almacen;
            unset($_produccion->almacen);
            unset($_produccion->caja);
            unset($_produccion->empleado);
            $_produccion->cliente;
            $_produccion->empleado = $empleado;
            $_produccion->caja = $caja;
            $_produccion->almacen= $almacen->codigo;
            $_produccion->detallesProduccion;
            foreach ($_produccion->detallesProduccion as $detalle) {
                $detalle->articulo = Articulo::find($detalle->id_articulo)->nombre;
            }
        }
        return $_producciones;
    }
    public static function forceGetProductionCredits() {

        $_producciones = Produccion::where('status', 'cv')
            ->orderBy('fecha_inicio', 'desc')->get();
        foreach ($_producciones as $_produccion) {
            $empleado = $_produccion->empleado->nombre;
            $caja = $_produccion->caja->nombre;
            $almacen = $_produccion->almacen;
            unset($_produccion->almacen);
            unset($_produccion->caja);
            unset($_produccion->empleado);
            $_produccion->cliente;
            $_produccion->empleado = $empleado;
            $_produccion->caja = $caja;
            $_produccion->almacen= $almacen->codigo;
            $_produccion->detallesProduccion;
            foreach ($_produccion->detallesProduccion as $detalle) {
                $detalle->articulo = Articulo::find($detalle->id_articulo)->nombre;
            }
        }
        return $_producciones;
    }
    public static function getProduccionById($id_produccion) {

        $_produccion = Produccion::find($id_produccion);
        $empleado = $_produccion->empleado->nombre;
        $caja = $_produccion->caja->nombre;
        $almacen = $_produccion->almacen;
        unset($_produccion->almacen);
        unset($_produccion->caja);
        unset($_produccion->empleado);
        $_produccion->cliente;
        $_produccion->empleado = $empleado;
        $_produccion->caja = $caja;
        $_produccion->almacen= $almacen->codigo;
        $_produccion->detallesProduccion;
        foreach ($_produccion->detallesProduccion as $detalle) {
            $detalle->articulo = Articulo::find($detalle->id_articulo)->nombre;
        }
        return $_produccion;
    }
}
