<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $table = 'subcategoria';
	protected $primaryKey = 'id_subcategoria';
	public $timestamps = false;
	
	protected $fillable = [
		'subcategoria',
		'descripcion',
		'id_categoria',
	];
	
	protected $guarded = [
	
	];
}
