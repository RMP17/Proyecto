<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Cambio extends Model
{
	
    protected $table = 'cambio';
	protected $primaryKey = 'id_cambio';
	public $timestamps = false;
	
	protected $fillable = [
		'id_moneda_1',
		'id_moneda_2',
		'valor_de_cambio'
	];
	
	protected $guarded = [
	
	];
	
}
