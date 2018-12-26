<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    protected $table = 'tipo_pago';
	protected $primaryKey = 'id_tipo_pago';
	public $timestamps = false;
	
	protected $fillable = [
		'tipo_pago',
	];
	
	protected $guarded = [
	
	];
}
