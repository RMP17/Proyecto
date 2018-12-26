<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Dimensiones extends Model
{
    protected $table = 'dimensiones';
	protected $primaryKey = 'id_articulo';
	public $timestamps = false;
	
	protected $fillable = [
		'largo',
		'ancho',
		'espesor',
		'volumen',
	];
	
	protected $guarded = [
	
	];
}
