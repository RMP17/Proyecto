<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    protected $table = 'moneda';
	protected $primaryKey = 'id_moneda';
	public $timestamps = false;
	
	protected $fillable = [
		'nombre',
		'codigo',
		'id_pais',
	];
	
	protected $guarded = [
	
	];
}
