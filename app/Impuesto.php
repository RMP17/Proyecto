<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    protected $table = 'impuesto';
	protected $primaryKey = 'id_impuesto';
	public $timestamps = false;
	
	protected $fillable = [
		'nombre',
		'alicuota',
		'estatus',
	];
	
	protected $guarded = [
	
	];
}
