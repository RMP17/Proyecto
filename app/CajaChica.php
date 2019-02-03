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
}
