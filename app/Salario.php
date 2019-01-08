<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Salario extends Model
{
    
    protected $table = 'salario';
	protected $primaryKey = 'id_kardex';
	public $timestamps = false;
	
	protected $fillable = [
		'monto',
		'id_moneda'
	];
	
	protected $guarded = [
	
	];
    public function moneda(){
        return $this->hasOne(Moneda::class,'id_moneda','id_kardex');
    }

}
