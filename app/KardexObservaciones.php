<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class KardexObservaciones extends Model
{
	
    protected $table = 'kardex_observaciones';
	protected $primaryKey = 'id_kardex_observaciones';
	public $timestamps = false;
	
	protected $fillable = [
		'id_kardex',
		'fecha',
		'observacion',
	];
	
	protected $guarded = [
	
	];
	
}
