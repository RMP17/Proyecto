<?php

namespace Allison;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class KardexObservaciones extends Model
{
	
    protected $table = 'kardex_observaciones';
	protected $primaryKey = 'id_kardex_observaciones';
	public $timestamps = false;
	
	protected $fillable = [
		'id_kardex',
		'observacion',
	];
	
	protected $guarded = [
	];
    public function kardex(){
        return $this->belongsTo(Kardex::class,'id_kardex');
    }
    public static function newKardexObservacion($parameters_observacion){
        $_kardex_observacion= new KardexObservaciones();
        $_kardex_observacion->fill($parameters_observacion);
        $_kardex_observacion->fecha = Carbon::now();
        $_kardex_observacion->save();
        return true;
    }
    public static function getKardexObservacionesOfKardex($id_kardex){
        $_kardex_observacion= KardexObservaciones::where('id_kardex',$id_kardex)->orderBy('fecha')->get();
        return $_kardex_observacion;
    }
    public static function updateKardexObservacion($parameters_observacion, $id_kardex_observaciones){
        $_kardex_observacion= KardexObservaciones::findOrFail($id_kardex_observaciones);
        $_kardex_observacion->fill($parameters_observacion);
        $_kardex_observacion->update();
        return true;
    }
}
