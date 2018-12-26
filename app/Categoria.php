<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
	protected $primaryKey = 'id_categoria';
	public $timestamps = false;
	
	protected $fillable = [
		'categoria',
		'descripcion',
	];
	
	protected $guarded = [
	
	];
}
