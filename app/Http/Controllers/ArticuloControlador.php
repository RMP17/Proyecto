<?php

namespace Allison\Http\Controllers;
use Allison\Http\Controllers\ConversorImagenes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Allison\Http\Requests\ArticuloPeticion;
use Allison\Articulo;
use Allison\Categoria;
use Allison\Fabricante;
use Allison\Dimensiones;
use Allison\Almacen;
use Allison\Bitacora;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ArticuloControlador extends Controller
{
    public function __construct()
	{
        $this->middleware('permiso_articulo', ['only' => ['index']]);
	}
	
	public function index()
	{
        $outputData=[
            'almacenes' => Almacen::getAlmacenes(),
        ];
        return view('articulo.index',$outputData);
	}

	public function store(/*ArticuloPeticion*/ Request $peticion)
	{

//        $conversor = new ConversorImagenes;
        $data = json_decode($peticion->data, true);
//        dd($peticion->allFiles());



        $validator = Validator::make($data, [
            'nombre' => 'required|max:50',
            'codigo' => 'required|unique:articulo,codigo|max:50',
            'codigo_barra' => 'required|max:50',
            'precio_compra' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        };
        $urlImage = null;
        $path = public_path().'/images';
        if (count($peticion->allFiles()) > 0) {
            $files = $peticion->allFiles();
            $validator2 = Validator::make($files, [
                'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($validator2->fails()) {
                return response()->json($validator2->errors(), 400);
            };
            $imageTempName = $files['imagen']->getPathname();
            $imageName = $files['imagen']->getClientOriginalName();
            $files['imagen']->move($path, now()->timestamp.$imageName);
            $urlImage = now()->timestamp.$imageName;
        }

        $articulo = new Articulo;
        $articulo->fill($data);
        $articulo->fecha_registro = Carbon::now();
        $articulo->estatus = 1;
        $articulo->imagen = $urlImage;
        $articulo->save();
        if($articulo->divisible){
            $dimensiones = new Dimensiones();
            $dimensiones->fill($data['dimensiones']);
            $dimensiones->volumen = $data['dimensiones']['largo']*$data['dimensiones']['ancho']*$data['dimensiones']['espesor'];
            $articulo->dimension()->save($dimensiones);
        }
        return response()->json();

	}
	
	public function show($id_articulo)
	{
		return view ('articulo.show', ['articulo' => Articulo :: findOrFail($id_articulo)]);
	}

	public function updateArticulo(/*ArticuloPeticion*/ Request $peticion, $id_articulo)
	{
        $data = json_decode($peticion->data, true);
        $articulo = Articulo::findOrFail($id_articulo);
        Bitacora::insertInBitacora('UPDATE', $articulo);
        if(is_null($articulo)){
            return response()->json('No Existe el Artículo', 400);
        }

        $validator = Validator::make($data, [
            'nombre' => 'required|max:50',
            'codigo' => ['required','max:50', Rule::unique('articulo')->ignore($articulo->codigo, 'codigo')],
            'codigo_barra' => 'required|max:50',
            'precio_compra' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        };

        $urlImage = null;
        $path = public_path().'/images/';
        if (count($peticion->allFiles()) > 0 ) {
            if (!is_null($articulo->imagen)) {
                $_temPath = $path.$articulo->imagen;
                if (File::exists($_temPath)) {
                    File::delete($_temPath);
                }
            }
            $files = $peticion->allFiles();
            $validator2 = Validator::make($files, [
                'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($validator2->fails()) {
                return response()->json($validator2->errors(), 400);
            };
            $imageTempName = $files['imagen']->getPathname();
            $imageName = $files['imagen']->getClientOriginalName();
            $files['imagen']->move($path, now()->timestamp.$imageName);
            $urlImage = now()->timestamp.$imageName;
        }

        $articulo->fill($data);
        unset($data['fecha_registro']);
        unset($data['estatus']);
        $articulo->imagen = $urlImage;
        $articulo->update();

        if($articulo->divisible){
            $data['dimensiones']['volumen'] = $data['dimensiones']['largo']*$data['dimensiones']['ancho']*$data['dimensiones']['espesor'];
            $articulo->dimension()->update($data['dimensiones']);
        }
        return response()->json();
	}
	
	public function destroy($id_articulo)
	{
		$articulo = Articulo :: findOrFail($id_articulo);
		$articulo->estatus = 'X';
		$articulo->update();
		return Redirect :: to ('articulo');
	}
	public function getArticuloByCodigoBarra($codigo_barras){
        return response()->json((new Articulo)->getArticuloBy('codigo-barras',$codigo_barras));
    }
    public function getArticuloStocksByCodigoBarra($codigo_barras){
        return response()->json(Articulo::getArticuloStocksBy('codigo-barras',$codigo_barras));
    }
    public function getArticuloStocksByCodigo($codigo_barras){
        return response()->json(Articulo::getArticuloStocksBy('codigo',$codigo_barras));
    }
    public function getArticuloByCodigo($codigo){
        return response()->json((new Articulo)->getArticuloBy('codigo',$codigo));
    }
    public function getArticuloByName($nombre){
        return response()->json((new Articulo)->getArticuloByName($nombre));
    }
    public function getArticuloStockByName($nombre){
        return response()->json(Articulo::getArticuloStockByName($nombre));
    }
    public function getArticuloById($id){
        return response()->json((new Articulo)->getArticuloById($id));
    }
    public function getArticulos(){
        return response()->json(Articulo::getArticulos());
    }
    public function getPreciosArticulo($id_articulo){
        return response()->json(Articulo::getPreciosArticulo($id_articulo));
    }
    public function changeStatusOfArticulo(Request $request, $id_articulo){
        $articulo = Articulo::findOrFail($id_articulo);
        $articulo->estatus = !$request->status;
        $articulo->update();
        return response()->json();
    }
    public function storePrecios(Request $request){
        $validator = Validator::make($request->all(), [
            'id_sucursal' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        };
        Articulo::newsPrecios($request->all());
        return response()->json();
    }
    public function getStock($id_articulo){
        $articulo = Articulo::getStock($id_articulo);
        return response()->json($articulo);
    }
}
