<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'pais';
	protected $primaryKey = 'id_pais';
	public $timestamps = false;
	
	protected $fillable = [
		'nombre',
	];
	
	protected $guarded = [
	
	];
}
