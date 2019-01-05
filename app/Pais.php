<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'pais';
	protected $primaryKey = 'id_pais';
	public $timestamps = false;

    public function ciudades(){
        return $this->hasMany(Ciudad::class, 'id_pais', 'id_pais');
    }
    public function monedas(){
        return $this->hasMany (Pais::class,'id_pais','id_pais');
    }
	protected $fillable = [
		'nombre',
	];
	
	protected $guarded = [
	
	];
}
