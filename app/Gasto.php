<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    protected $table = 'gasto';
	protected $primaryKey = 'id';
	public $timestamps = false;
	
	protected $fillable = [
		'monto',
		'descripcion',
		'id_caja_chica',
	];
	
	protected $guarded = [
	
	];
}
