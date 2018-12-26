<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacora';
	protected $primaryKey = 'id';
	public $timestamps = false;
	
	protected $fillable = [
		'usuario',
		'accion',
		'fecha',
	];
	
	protected $guarded = [
	
	];
}
