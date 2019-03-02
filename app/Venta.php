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
        'importe',
		'costo_tarjeta_cheque',
		'descuento',
		'id_moneda',
		'id_cliente',
        // Tipo de pago trabaja con estos valores:
        // ef=Efectivo; cr=al credito; ch=cheque; tc=Tarjeta de crédito o débito.
		'tipo_pago',
	];
	
	protected $guarded = [
        'id_caja',
        'id_empleado',
        'id_almacen',
        // null=venta en efectivo; cv= credito vigente; cc= credito cancelado; vc=venta cancelada
        'estatus',
	];
    public function detallesVenta(){
        return $this->hasMany(DetalleVenta::class,'id_venta', 'id_venta');
    }
    public function ventaCredito(){
        return $this->hasMany(VentaCredito::class,'id_venta', 'id_venta');
    }
    public function cliente(){
        return $this->belongsTo(Cliente::class,'id_cliente');
    }
    public function empleado(){
        return $this->belongsTo(Empleado::class,'id_empleado');
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
	public static function newVenta($parameters){
        DB::beginTransaction();
        try {
            $parameters['descuento'] = !is_null($parameters['descuento']) ? $parameters['descuento'] : 0;
            $empleado = Empleado::find(auth()->user()->id_empleado);
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
            $_venta = new Venta();
            $_venta->fill($parameters);
            $_venta->id_empleado=$empleado->id_empleado;
            $_venta->id_almacen=$empleado->id_almacen;
            $_venta->fecha = Carbon::now()->toDateTimeString();
            $caja = Caja::where('id_empleado', $empleado->id_empleado)->first();
            if (is_null($caja)) {
                return [
                    'message' => [
                        'errors' => [
                            'caja'=>['No está asignado a ninguna caja']
                        ]
                    ],
                    'code' => 400
                ];
            }
            $_venta->id_caja = $caja->id_caja;
            foreach ($parameters['detalles_venta'] as $detalle) {
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
            $_venta->costo_total = self::calcularTotal($parameters['detalles_venta']);
            if(is_null($parameters['importe']) || $parameters['importe'] == 0 ){
                $parameters['importe'] = $_venta->costo_total;
            } else if( $parameters['importe'] < $_venta->costo_total ){
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

            foreach ($parameters['detalles_venta'] as $detalle) {
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
            DB::commit();
            $cliente = $_venta->cliente;
            $empleado = $_venta->empleado;
            $caja = $_venta->caja;
            $almacen = $_venta->almacen;
            $moneda = $_venta->moneda;
            $sucursal = Sucursal::find($almacen->id_sucursal);
            unset($_venta->cliente);
            unset($_venta->empleado);
            unset($_venta->caja);
            unset($_venta->moneda);
            unset($_venta->almacen);
            $sucursal->empresa;
            $_venta->cliente = ['razon_social'=>$cliente->razon_social,'nit'=>$cliente->nit];
            $_venta->empleado = $empleado->nombre;
            $_venta->caja = $caja->nombre;
            $_venta->moneda = $moneda->codigo;
            $_venta->almacen = $almacen;
            $_venta->sucursal = $sucursal;
            $_venta->detallesVenta;
            foreach ($_venta->detallesVenta as $detalle) {
                $detalle->articulo = Articulo::find($detalle->id_articulo)->nombre;
            }
            return [
                'data' => $_venta,
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
    public static function getVentasByRageDate($date1, $date2) {

        $ventas = Venta::whereBetween('fecha', [$date1.' 00:00:00',$date2.' 23:59:59'])
            ->orderBy('fecha', 'desc')->get();
        foreach ($ventas as $venta) {
            if (isset($venta->cliente->razon_social)) {
                $cliente = $venta->cliente->razon_social;
                $venta->nit = $venta->cliente->nit;
            } else {
                $venta->nit = '';
                $cliente = '';
            }
            unset($venta->cliente);
            $venta->cliente = $cliente;
            $empleado = $venta->empleado->nombre;
            unset($venta->empleado);
            $venta->empleado = $empleado;
            $caja = $venta->caja->nombre;
            unset($venta->caja);
            $venta->caja = $caja;
            $moneda = $venta->moneda->codigo;
            unset($venta->moneda);
            $venta->moneda= $moneda;
            $almacen = $venta->almacen;
            unset($venta->almacen);
            $venta->almacen= $almacen->codigo;
            $venta->detallesVenta;
            foreach ($venta->detallesVenta as $detalle) {
                $detalle->articulo = Articulo::find($detalle->id_articulo)->nombre;
            }
        }
        return $ventas;
    }
    public static function getVentaById($id_venta) {
        $venta = Venta::find($id_venta);
        $cliente = $venta->cliente;
        $empleado = $venta->empleado;
        $caja = $venta->caja;
        $almacen = $venta->almacen;
        $moneda = $venta->moneda;
        $sucursal = Sucursal::find($almacen->id_sucursal);
        unset($venta->cliente);
        unset($venta->empleado);
        unset($venta->caja);
        unset($venta->moneda);
        unset($venta->almacen);
        $sucursal->empresa;
        $venta->cliente = ['razon_social'=>$cliente->razon_social,'nit'=>$cliente->nit];
        $venta->empleado = $empleado->nombre;
        $venta->caja = $caja->nombre;
        $venta->moneda = $moneda->codigo;
        $venta->almacen = $almacen;
        $venta->sucursal = $sucursal;
        $venta->detallesVenta;
        foreach ($venta->detallesVenta as $detalle) {
            $detalle->articulo = Articulo::find($detalle->id_articulo)->nombre;
        }
        return $venta;
    }
    public static function getSalesOnCreditInForce() {

        $ventas = Venta::where('estatus', 'cv')
            ->orderBy('fecha', 'desc')->get();
        foreach ($ventas as $venta) {
            if (isset($venta->cliente->razon_social)) {
                $cliente = $venta->cliente->razon_social;
                $venta->nit = $venta->cliente->nit;
            } else {
                $venta->nit = '';
                $cliente = '';
            }
            unset($venta->cliente);
            $venta->cliente = $cliente;
            $empleado = $venta->empleado->nombre;
            unset($venta->empleado);
            $venta->empleado = $empleado;
            $caja = $venta->caja->nombre;
            unset($venta->caja);
            $venta->caja = $caja;
            $moneda = $venta->moneda->codigo;
            unset($venta->moneda);
            $venta->moneda= $moneda;
            $venta->detallesVenta;
            $almacen = $venta->almacen;
            unset($venta->almacen);
            $venta->almacen= $almacen->codigo;
            $venta->detallesVenta;
            foreach ($venta->detallesVenta as $detalle) {
                $detalle->articulo = Articulo::find($detalle->id_articulo)->nombre;
            }
        }
        return $ventas;
    }
    public static function cancelSale($id_venta) {
        $venta = Venta::find($id_venta);
        Bitacora::insertInBitacora('DELETE', $venta);
        $venta->estatus='vc';
        $venta->detallesVenta;
        foreach ($venta->detallesVenta as $detalle) {
            $stock = Stock::where('id_articulo', $detalle['id_articulo'])
                ->where('id_almacen', $venta->id_almacen)->lockForUpdate()->first();
            if (!is_null($stock)) {
                $stock->cantidad = $stock->cantidad +(int)$detalle['cantidad'];
                $stock->update();
            }
        }
        $venta->update();
        return null;
    }
}