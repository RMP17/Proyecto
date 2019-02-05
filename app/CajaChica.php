<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class CajaChica extends Model
{
    protected $table = 'caja_chica';
	protected $primaryKey = 'id_caja_chica';
	public $timestamps = false;
	
	protected $fillable = [
		'fecha_apertura',
		'fecha_cierre',
		'monto_apertura',
		'diferencia',
		'monto_declarado',
		'observaciones',
		'id_caja',
	];
	
	protected $guarded = [
	
	];
    public function caja(){
        return $this->belongsTo(Caja::class,'id_caja');
    }
    public static function getCajaChicaByRangeDate($date1, $date2) {
        $cajasChicas = CajaChica::whereBetween('fecha_apertura', [$date1.' 00:00:00',$date2.' 23:59:59'])
            ->orderBy('fecha_apertura', 'desc')->get();
        foreach ($cajasChicas as $cajaChica) {
            $tempCajaChica=$cajaChica->caja;
            unset($cajaChica->caja);
            $cajaChica->caja= $tempCajaChica->nombre;
        }
        return $cajasChicas;
    }
}
