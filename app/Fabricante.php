<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
    protected $table = 'fabricante';
	protected $primaryKey = 'id_fabricante';
	public $timestamps = false;
	
	protected $fillable = [
		'nombre',
		'contacto',
		'sitio_web',
	];
	
	protected $guarded = [
	
	];
}
