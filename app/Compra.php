<?php

namespace Allison;

use Allison\Http\Controllers\CompraCreditoController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Compra extends Model
{
    protected $table = 'compra';
	protected $primaryKey = 'id_compra';
	public $timestamps = false;
	
	protected $fillable = [
		'fecha',
		'descuento',
		'codigo_tarjeta_cheque',
		'observaciones',
		'estatus',
		'nro_factura',
		'id_moneda',
		'id_proveedor',
        // TIpo de pago trabaja con estos valores:
        // ef=Efectivo; cr=al credito; ch=cheque; tc=Tarjeta de crédito o débito.
        'tipo_pago'
	];
    public function detallesCompra(){
        return $this->hasMany(DetalleCompra::class,'id_compra', 'id_compra');
    }
    public function compraCredito(){
        return $this->hasMany(CompraCredito::class,'id_compra', 'id_compra');
    }
    public function moneda(){
        return $this->belongsTo(Moneda::class,'id_moneda');
    }
    public function empleado(){
        return $this->belongsTo(Empleado::class,'id_empleado');
    }
    public function proveedor(){
        return $this->belongsTo(Proveedor::class,'id_proveedor');
    }
    public function detalleCompra(){
        return $this->hasMany(DetalleCompra::class,'id_compra','id_compra');
    }
	public static function newCompra($parameters_compra){

        DB::beginTransaction();
        try {
            $_compra = new Compra();
            $parameters_compra['descuento'] = !is_null($parameters_compra['descuento']) ? $parameters_compra['descuento'] : 0;
            $_compra->fill($parameters_compra);
            $_compra->id_empleado = auth()->user()->id_empleado;
            $_compra->costo_total = self::calcularTotal($parameters_compra['detalles_compra']);
            // Status
            // cc: credito cancelado; cv: credito cancelado y null significa que no existe credito
            if($parameters_compra['tipo_pago']=='cr') {
                $_compra->estatus = 'cv';
            }
            $_compra->save();
            $_compra->detallesCompra()->createMany($parameters_compra['detalles_compra']);

            foreach ($parameters_compra['detalles_compra'] as $detalle) {
                $articulo = Articulo::find($detalle['id_articulo']);
                $dimension= $articulo->dimension;
                $stock = Stock::where('id_articulo', $detalle['id_articulo'])
                    ->where('id_almacen', $detalle['id_almacen'])->lockForUpdate()->first();
                if (is_null($stock)) {
                    $_stock = new Stock();
                    $_stock->id_articulo = $detalle['id_articulo'];
                    $_stock->id_almacen = $detalle['id_almacen'];
                    if ($articulo->divisible){
                        $_stock->cantidad = $detalle['cantidad'] * $dimension->ancho * $dimension->largo;
                    }else {
                        $_stock->cantidad = $detalle['cantidad'];
                    }
                    $_stock->save();
                } else {
                    if ($articulo->divisible){
                        $stock->cantidad += (int)$detalle['cantidad'] * $dimension->ancho * $dimension->largo;
                    }else {
                        $stock->cantidad += (int)$detalle['cantidad'];
                    }
                    $stock->update();
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }

        
    }
    public static function getComprasByRageDate($date1, $date2) {

        $compras = Compra::whereBetween('fecha', [$date1.' 00:00:00',$date2.' 23:59:59'])
            ->orderBy('id_compra', 'desc')->get();
        foreach ($compras as $compra) {
            if (isset($compra->proveedor->razon_social)) {
                $proveedor = $compra->proveedor->razon_social;
                $compra->nit = $compra->proveedor->nit;
            } else {
                $compra->nit = '';
                $proveedor = '';
            }
            unset($compra->proveedor);
            $compra->proveedor = $proveedor;
            $empleado = $compra->empleado->nombre;
            unset($compra->empleado);
            $compra->empleado = $empleado;
            $moneda = $compra->moneda->codigo;
            unset($compra->moneda);
            $compra->moneda= $moneda;
            $compra->detalleCompra;
            $almacen = null;
            foreach ($compra->detalleCompra as $detalle) {
                if (is_null($almacen)) {
                    $almacen = Almacen::find($detalle->id_almacen)->codigo;
                }
                $detalle->articulo = Articulo::find($detalle->id_articulo)->nombre;
                $compra->almacen = $almacen;
            }
        }
        return $compras;
    }
    public static function getPurchasesOnCreditInForce() {

        $compras = Compra::where('estatus', 'cv')
            ->orderBy('id_compra', 'desc')->get();
        foreach ($compras as $compra) {
            if (isset($compra->proveedor->razon_social)) {
                $proveedor = $compra->proveedor->razon_social;
                $compra->nit = $compra->proveedor->nit;
            } else {
                $compra->nit = '';
                $proveedor = '';
            }
            unset($compra->proveedor);
            $compra->proveedor = $proveedor;
            $empleado = $compra->empleado->nombre;
            unset($compra->empleado);
            $compra->empleado = $empleado;
            $moneda = $compra->moneda->codigo;
            unset($compra->moneda);
            $compra->moneda= $moneda;
            $compra->detalleCompra;
            $almacen = null;
            foreach ($compra->detalleCompra as $detalle) {
                if (is_null($almacen)) {
                    $almacen = Almacen::find($detalle->id_almacen)->codigo;
                }
                $detalle->articulo = Articulo::find($detalle->id_articulo)->nombre;
                $compra->almacen = $almacen;
            }
        }
        return $compras;
    }
    private static function calcularTotal(&$detallesCompra){
        $costo_total=0;
        foreach ($detallesCompra as &$detalle) {
            $subtotal = $detalle['cantidad'] * $detalle['precio_unitario'];
            $detalle['subtotal'] = $subtotal+1000;
            $costo_total+= $subtotal;
        }
        return $costo_total;
    }
}
