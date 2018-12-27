<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'articulo';
	protected $primaryKey = 'id_articulo';
	public $timestamps = false;
	
	protected $fillable = [
		'nombre',
		'codigo',
		'codigo_barra',
		'caracteristicas',
		'precio_compra',
		'precio_produccion',
		'estatus',
		'imagen',
		'fecha_registro',
		'divisible',
		'id_categoria',
		'id_fabricante',
	];
	
	protected $guarded = [
	
	];
    public function dimension(){
        return $this->hasOne(Dimensiones::class,'id_articulo', 'id_articulo');
    }
}
