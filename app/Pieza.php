<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Pieza extends Model
{
    protected $table = 'pieza';
	protected $primaryKey = 'id_pieza';
	public $timestamps = false;
	
	protected $fillable = [
		'id_articulo',
		'corte',
	];
	
	protected $guarded = [
	
	];
}
