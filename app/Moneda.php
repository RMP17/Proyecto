<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    protected $table = 'moneda';
	protected $primaryKey = 'id_moneda';
	protected $fillable = ['nombre', 'codigo', 'id_pais'];
	public $timestamps = false;

	protected $guarded = [

	];
    public function pais(){
        return $this->belongsTo(Pais::class,'id_pais');
    }

}
