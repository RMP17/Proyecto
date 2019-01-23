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
        $array = [];
        if($key=='codigo'){
            $articulo = Articulo::where('codigo',$codigo)->first();
        } else if ($key=='codigo-barras') {
            $articulo = Articulo::where('codigo_barra',$codigo)->first();
        }
        if(!is_null($articulo)){
            $articulo->categoria = Categoria::find($articulo['id_categoria']);
            $articulo->fabricante = Fabricante::find($articulo['id_fabricante']);
            $empleado = Empleado::find(auth()->user()->id_empleado);
            $almacenes = Almacen::where('id_sucursal', $empleado->id_sucursal)->get();
            $totalStock = 0;
            foreach ($almacenes as $almacen) {
                $stock = Stock::where('id_almacen',$almacen->id_almacen)
                    ->where('id_articulo',$articulo->id_articulo)->first();
                if(!is_null($stock)) {
                    $totalStock+=$stock->cantidad;
                }
            }
            $articulo->stock = $totalStock;
            unset($articulo->id_categoria);
            unset($articulo->id_fabricante);
            if(is_null($articulo->dimension)) {
                $articulo->dimensiones=[
                    'largo' => null,
                    'ancho' => null,
                    'espesor' => null,
                    'volumen' => null
                ];
            } else {
                $articulo->dimensiones=$articulo->dimension;
                unset($articulo->dimension);
            }
            $array[]=$articulo;
        }
        return  $array;
    }
    public function getArticuloByName($nombre){

        $articulos = Articulo::where('nombre', 'like','%'.$nombre.'%')
            ->orderBy('nombre','desc')->take(10)->get();
        foreach ($articulos as &$articulo) {
            $articulo->categoria = Categoria::find($articulo['id_categoria']);
            $articulo->fabricante = Fabricante::find($articulo['id_fabricante']);
            $empleado = Empleado::find(auth()->user()->id_empleado);
            $almacenes = Almacen::where('id_sucursal', $empleado->id_sucursal)->get();
            $totalStock = 0;
            foreach ($almacenes as $almacen) {
                $stock = Stock::where('id_almacen',$almacen->id_almacen)
                    ->where('id_articulo',$articulo->id_articulo)->first();
                if(!is_null($stock)) {
                    $totalStock+=$stock->cantidad;
                }
            }
            $articulo->stock = $totalStock;
            if(is_null($articulo->dimension)) {
                $articulo->dimensiones=[
                    'largo' => null,
                    'ancho' => null,
                    'espesor' => null,
                    'volumen' => null
                ];
            } else {
                $articulo->dimensiones=$articulo->dimension;
                unset($articulo->dimension);
            }
        }

        return $articulos;
    }
    public function getArticuloById($id){

        $articulo = Articulo::find($id);
        if(!is_null($articulo)){
            $articulo->categoria = Categoria::find($articulo['id_categoria']);
            $articulo->fabricante = Fabricante::find($articulo['id_fabricante']);
            $empleado = Empleado::find(auth()->user()->id_empleado);
            $almacenes = Almacen::where('id_sucursal', $empleado->id_sucursal)->get();
            $totalStock = 0;
            foreach ($almacenes as $almacen) {
                $stock = Stock::where('id_almacen',$almacen->id_almacen)
                    ->where('id_articulo',$articulo->id_articulo)->first();
                if(!is_null($stock)) {
                    $totalStock+=$stock->cantidad;
                }
            }
            $articulo->stock = $totalStock;
            if(is_null($articulo->dimension)) {
                $articulo->dimensiones=[
                    'largo' => null,
                    'ancho' => null,
                    'espesor' => null,
                    'volumen' => null
                ];
            } else {
                $articulo->dimensiones=$articulo->dimension;
                unset($articulo->dimension);
            }
        }
        $array[]=$articulo;
        return  $array;
    }
}
