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
    public function cajaChica(){
        return $this->hasMany(CajaChica::class,'id_caja', 'id_caja');
    }
    public function empleado(){
        return $this->belongsTo(Empleado::class,'id_empleado');
    }

    public static function newCaja($parameters){
        $caja = new Caja();
        $caja->fill($parameters);
        $caja->save();
    }
    public static function updateCaja($parameters){
        $caja = Caja::find($parameters['id_caja']);
        $caja->fill($parameters);
        $caja->update();
    }
    public static function getCajas(){
        $cajas = Caja::select('*')->orderBy('nombre')->get();
        foreach ($cajas as $caja) {
            $empleado=[
                'nombre' => $caja->empleado->nombre,
                'id_empelado' => $caja->empleado->id_empleado
            ];
            unset($caja->empleado);
            $caja->empleado=$empleado;
        }
        return $cajas;
    }
    public static function getCaja(){
        $cajas = Caja::where('id_empleado', auth()->user()->id_empleado)->first();
        if(!is_null($cajas)){
            return $cajas;
        } else {
            return [
                'messages'=>[
                    'caja'=>['El empleado no esta asignado a niguna caja']
                ],
                'code'=>400
            ];
        }
    }
    public static function closedAndOpenCashier($parameters){
        $caja = Caja::where('id_empleado',auth()->user()->id_empleado)->first();
        if(!is_null($caja)){
            if(is_null($caja->status) || $caja->status=='c'){
                $cajaChica=new CajaChica();
                $cajaChica->monto_apertura=$parameters['monto'];
                $cajaChica->fecha_apertura=Carbon::now();
                $caja->cajaChica()->save($cajaChica);
                $caja->status= 'a';
                $caja->update();
            } else if($caja->status=='a') {
                $cajaChica=CajaChica::where('fecha_cierre',null)->first();
                $cajaChica->monto_declarado=$parameters['monto'];
                $cajaChica->diferencia=$parameters['diferencia'];
                $cajaChica->observaciones=$parameters['observaciones'];
                $cajaChica->fecha_cierre=Carbon::now();
                $cajaChica->update();
                $caja->status= 'c';
                $caja->update();
            }
            return null;
        }
        return [
            'messages'=>[
                'caja'=>['El empleado no esta asignado a niguna caja']
            ],
            'code'=>400
        ];
    }
}
