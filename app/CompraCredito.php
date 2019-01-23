<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CompraCredito extends Model
{
    protected $table = 'compra_credito';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'monto',
        'tipo_pago',
        'opservaciones',
    ];

    protected $guarded = [
        'id_compra'
    ];
    public function compra(){
        return $this->belongsTo(Compra::class,'id_compra');
    }
    public static function newCompraCredito($parameters_compra_credito){

        $_compra= Compra::find($parameters_compra_credito['id_compra']);
        $compra_credito_total= CompraCredito::where('id_compra',$parameters_compra_credito['id_compra'])->sum('monto');
        if($compra_credito_total>$_compra->costo_total) {
            return false;
        }
        $compra_credito = new CompraCredito();
        $compra_credito->fill($parameters_compra_credito);
        if($compra_credito_total + $parameters_compra_credito['monto']<=$_compra->costo_total){
            $compra_credito->monto = $parameters_compra_credito['monto'];
        } else {
            $compra_credito->monto = $_compra->costo_total-$compra_credito_total;
            if($compra_credito->monto==0) {
                return false;
            }
            $_compra->estatus = 'cc';
            $_compra->update();
        }
        if( $compra_credito->monto + $compra_credito_total - $_compra->costo_total==0) {
            $_compra->estatus = 'cc';
            $_compra->update();
        }

        $compra_credito->fecha=Carbon::now();
        $_compra->compraCredito()->save($compra_credito);
        return true;
    }
    public static function getCreditoCompra($id_compra){
        $_compra= CompraCredito::where('id_compra',$id_compra)->get();
        return $_compra;
    }
}
