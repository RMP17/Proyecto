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
    public function sucursal(){
        return $this->belongsToMany(Sucursal::class,'articulos_sucursales','id_articulo', 'id_sucursal')
            ->withPivot('precio_1','precio_2','precio_3','precio_4','precio_5');
    }
    public function stock(){
        return $this->hasMany(Stock::class,'id_articulo', 'id_articulo');
    }
    public static function getArticulos(){
        $array = [];
        $articulos = Articulo::select('*')->orderBy('nombre')->get();
        if(count($articulos)>0){
            foreach ($articulos as &$articulo){
                $categoria = Categoria::find($articulo['id_categoria']);
                if(!is_null($categoria)){
                    $articulo->categoria = $categoria;
                } else {
                    $articulo->categoria = ['categoria'=>''];
                }
                $fabricante = Fabricante::find($articulo['id_fabricante']);
                if(!is_null($fabricante)) {
                    $articulo->fabricante = $fabricante;
                } else {
                    $articulo->fabricante = ['nombre'=>''];
                }
                $empleado = Empleado::find(auth()->user()->id_empleado);
                $almacenes = Almacen::where('id_almacen', $empleado->id_almacen)->get();
                $totalStock = 0;
                foreach ($almacenes as $almacen) {
                    $stock = Stock::where('id_almacen',$almacen->id_almacen)
                        ->where('id_articulo',$articulo->id_articulo)->first();
                    if(!is_null($stock)) {
                        $dimension =$articulo->dimension;
                        if($articulo->divisible){
                            $totalStock+= round(($stock->cantidad)/($dimension->ancho*$dimension->largo),1);
                        } else {
                            $totalStock+=$stock->cantidad;
                        }
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
        }
        return  $array;
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
            if(count($articulo->sucursal)>0){
                $sucursal= $articulo->sucursal->first();
                $articulo->precios = $sucursal->pivot;
            }
            $categoria = Categoria::find($articulo['id_categoria']);
            if(!is_null($categoria)){
                $articulo->categoria = $categoria;
            } else {
                $articulo->categoria = ['categoria'=>''];
            }
            $fabricante = Fabricante::find($articulo['id_fabricante']);
            if(!is_null($fabricante)) {
                $articulo->fabricante = $fabricante;
            } else {
                $articulo->fabricante = ['nombre'=>''];
            }
            $empleado = Empleado::find(auth()->user()->id_empleado);
            $almacenes = Almacen::where('id_almacen', $empleado->id_almacen)->get();
            $totalStock = 0;
            foreach ($almacenes as $almacen) {
                $stock = Stock::where('id_almacen',$almacen->id_almacen)
                    ->where('id_articulo',$articulo->id_articulo)->first();
                if(!is_null($stock)) {
                    $dimension =$articulo->dimension;
                    if($articulo->divisible){
                        $totalStock+= round(($stock->cantidad)/($dimension->ancho*$dimension->largo),1);
                    } else {
                        $totalStock+=$stock->cantidad;
                    }
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
    public static function getArticuloStocksBy($key, $codigo){
        $articulo = null;
        if($key=='codigo'){
            $articulo = Articulo::where('codigo',$codigo)->first();
        } else if ($key=='codigo-barras') {
            $articulo = Articulo::where('codigo_barra',$codigo)->first();
        }
        if(!is_null($articulo)){
            if(count($articulo->sucursal)>0){
                $sucursal= $articulo->sucursal->first();
                $articulo->precios = $sucursal->pivot;
            }
            $categoria = Categoria::find($articulo['id_categoria']);
            if(!is_null($categoria)){
                $articulo->categoria = $categoria;
            } else {
                $articulo->categoria = ['categoria'=>''];
            }
            $fabricante = Fabricante::find($articulo['id_fabricante']);
            if(!is_null($fabricante)) {
                $articulo->fabricante = $fabricante;
            } else {
                $articulo->fabricante = ['nombre'=>''];
            }
            $articulo->stock;
            foreach ($articulo->stock as &$stock){
                $stock->almacen=Almacen::find($stock->id_almacen)->codigo;
            }
            unset($articulo->id_categoria);
            unset($articulo->id_fabricante);
        }
        return  $articulo;
    }
    public function getArticuloByName($nombre){

        $articulos = Articulo::where('nombre', 'like','%'.$nombre.'%')
            ->orderBy('nombre','desc')->take(10)->get();
        foreach ($articulos as $articulo) {
            $categoria = Categoria::find($articulo['id_categoria']);
            $articulo->precios=(Object)[];
            if(count($articulo->sucursal)>0){
                $sucursal= $articulo->sucursal->first();
                $articulo->precios = $sucursal->pivot;
            }
            if(!is_null($categoria)){
                $articulo->categoria = $categoria;
            } else {
                $articulo->categoria = ['categoria'=>''];
            }
            $fabricante = Fabricante::find($articulo['id_fabricante']);
            if(!is_null($fabricante)) {
                $articulo->fabricante = $fabricante;
            } else {
                $articulo->fabricante = ['nombre'=>''];
            }
            $empleado = Empleado::find(auth()->user()->id_empleado);
            $almacenes = Almacen::where('id_almacen', $empleado->id_almacen)->get();
            $totalStock = 0;
            foreach ($almacenes as $almacen) {
                $stock = Stock::where('id_almacen',$almacen->id_almacen)
                    ->where('id_articulo',$articulo->id_articulo)->first();
                if(!is_null($stock)) {
                    $dimension =$articulo->dimension;
                    if($articulo->divisible){
                        $totalStock+= round(($stock->cantidad)/($dimension->ancho*$dimension->largo),1);
                    } else {
                        $totalStock+=$stock->cantidad;
                    }
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
    public static function getArticuloStockByName($nombre){ // se usa para movimiento de almacen

        $articulos = Articulo::where('nombre', 'like','%'.$nombre.'%')
            ->orderBy('nombre','desc')->take(10)->get();
        foreach ($articulos as $articulo) {
            $categoria = Categoria::find($articulo['id_categoria']);
            $articulo->precios=(Object)[];
            if(count($articulo->sucursal)>0){
                $sucursal= $articulo->sucursal->first();
                $articulo->precios = $sucursal->pivot;
            }
            if(!is_null($categoria)){
                $articulo->categoria = $categoria;
            } else {
                $articulo->categoria = ['categoria'=>''];
            }
            $fabricante = Fabricante::find($articulo['id_fabricante']);
            if(!is_null($fabricante)) {
                $articulo->fabricante = $fabricante;
            } else {
                $articulo->fabricante = ['nombre'=>''];
            }
            $empleado = Empleado::find(auth()->user()->id_empleado);
            $almacenes = Almacen::where('id_almacen', $empleado->id_almacen)->get();
            $articulo->stock;
            foreach ($articulo->stock as $stock){
                $stock->almacen=Almacen::find($stock->id_almacen)->codigo;
                if($articulo->divisible){
                    $dimension =$articulo->dimension;
                    $stock->cantidad= round(($stock->cantidad)/($dimension->ancho*$dimension->largo),5);
                }
            }

        }

        return $articulos;
    }
    public function getArticuloById($id){

        $articulo = Articulo::find($id);
        if(!is_null($articulo)){
            $categoria = Categoria::find($articulo['id_categoria']);
            if(count($articulo->sucursal)>0){
                $sucursal= $articulo->sucursal->first();
                $articulo->precios = $sucursal->pivot;
            }
            if(!is_null($categoria)){
                $articulo->categoria = $categoria;
            } else {
                $articulo->categoria = ['categoria'=>''];
            }
            $fabricante = Fabricante::find($articulo['id_fabricante']);
            if(!is_null($fabricante)) {
                $articulo->fabricante = $fabricante;
            } else {
                $articulo->fabricante = ['nombre'=>''];
            }
            $empleado = Empleado::find(auth()->user()->id_empleado);
            $almacenes = Almacen::where('id_almacen', $empleado->id_almacen)->get();
            $totalStock = 0;
            foreach ($almacenes as $almacen) {
                $stock = Stock::where('id_almacen',$almacen->id_almacen)
                    ->where('id_articulo',$articulo->id_articulo)->first();
                if(!is_null($stock)) {
                    $dimension =$articulo->dimension;
                    if($articulo->divisible){
                        $totalStock+= round(($stock->cantidad)/($dimension->ancho*$dimension->largo),1);
                    } else {
                        $totalStock+=$stock->cantidad;
                    }
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
    public static function getPreciosArticulo($id_articulo){
        $articulo = Articulo::find($id_articulo);
        $precios=[];
        if(count($articulo->sucursal)>0){
            foreach ( $articulo->sucursal as $sucursal ){
                $sucursal->pivot->sucursal=Sucursal::find($sucursal->id_sucursal)->nombre;
                array_push($precios,$sucursal->pivot);
            }
        }
        return  $precios;
    }
    public static function newsPrecios($parameters){

        $articulo = Articulo::find($parameters['id_articulo']);
        $modelPrecios=[
            'precio_1',
            'precio_2',
            'precio_3',
            'precio_4',
            'precio_5'
        ];
        $modelPrecios=array_intersect_key($parameters,array_flip($modelPrecios));
        $precios[$parameters['id_sucursal']]=$modelPrecios;
        if(!is_null($articulo)){
            $articulo->sucursal()->syncWithoutDetaching($precios);
            Bitacora::insertInBitacora('UPDATE', $parameters);
        }
    }
    public static function getStock($id_articulo){
        $articulo = Articulo::find($id_articulo);
        foreach ($articulo->stock as $stock) {
            $stock->almacen= Almacen::find($stock->id_almacen)->codigo;
            if($articulo->divisible){
                $dimension =$articulo->dimension;
                $stock->cantidad= round(($stock->cantidad)/($dimension->ancho*$dimension->largo),5);
            }
        }
        return $articulo->stock;
    }
}
