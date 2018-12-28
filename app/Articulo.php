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
    public function getArticuloBy($key, $codigo){
        $articulo = null;
        if($key=='codigo'){
            $articulo = Articulo::where('codigo',$codigo)->first();
        } else if ($key=='codigo-barras') {
            $articulo = Articulo::where('codigo_barra',$codigo)->first();
        }
        if(!is_null($articulo)){
            $articulo->categoria = Categoria::find($articulo['id_categoria']);
            $articulo->fabricante = Fabricante::find($articulo['id_fabricante']);
        }
        return $articulo;
    }
    public function getArticuloByName($codigo){

        $articulo = Articulo::where('nombre', 'like','%'.$codigo.'%')
            ->select('id_articulo','nombre','codigo','codigo_barra')->orderBy('nombre','desc')->take(10)->get();
        return $articulo;
    }
}
