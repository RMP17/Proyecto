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
use Allison\Pieza;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ArticuloControlador extends Controller
{
    public function __construct()
	{
		
	}
	
	public function index()
	{	
		/*if ($peticion)
		{
			$consulta = trim($peticion->get('txtBuscar'));
			$articulos = DB::table('articulo')
				->join('subcategoria', 'articulo.id_subcategoria', '=', 'subcategoria.id_subcategoria')
				->join('fabricante', 'articulo.id_fabricante', '=', 'fabricante.id_fabricante')
				->where('articulo.nombre', 'like', '%'.$consulta.'%')
				->orderBy('nombre', 'asc')
				->select('articulo.id_articulo as id_articulo',
							'articulo.nombre as nombre',
							'articulo.codigo as codigo',
							'articulo.codigo_barra as codigo_barra',
							'articulo.caracteristicas as caracteristicas',
							'articulo.precio_compra as precio_compra',
							'articulo.precio_produccion as precio_produccion',
							'articulo.estatus as estatus',
							'articulo.imagen as imagen',
							'articulo.fecha_registro as fecha_registro',
							'articulo.divisible as divisible',
							'articulo.id_subcategoria as id_subcategoria',
							'articulo.id_fabricante as id_fabricante',
							'subcategoria.subcategoria as subcategoria',
							'fabricante.nombre as fabricante'
							)
				->get();

		}*/
        return view('articulo.index');
	}
	
	public function create()
	{
		$categorias = Categoria::orderBy('categoria', 'asc')
			->get();
		$fabricantes = Fabricante::orderBy('nombre','asc')
			->get();
		return view('articulo.create', compact('categorias', 'fabricantes'));
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
            'precio_produccion' => 'required'
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
	
	public function edit($id_articulo)
	{
		$categorias = Categoria::orderBy('categoria', 'asc')
			->get();
		$subcategorias = Subcategoria::orderBy('subcategoria','asc')
			->get();
		$fabricantes = Fabricante::orderBy('nombre', 'asc')
			->get();
		$articulo = Articulo :: findOrFail($id_articulo);
		$id_subcategoria = $articulo -> id_subcategoria;
		$categoria = Categoria::join('subcategoria', 'categoria.id_categoria', '=', 'subcategoria.id_categoria')
			->where('subcategoria.id_subcategoria', '=', $id_subcategoria)
			->select('categoria.id_categoria as id_categoria', 'categoria.categoria as categoria')
			->first();
		$subcategoria = "";
		foreach($subcategorias as $s) { if($s->id_subcategoria == $id_subcategoria) { $subcategoria = $s->subcategoria; break; } }
		$fabricante = Fabricante::where('id_fabricante', '=', $articulo->id_fabricante)
			->first()
			->nombre;
		$dimensiones = Dimensiones::where('id_articulo', '=', $id_articulo)
			->first();
		return view ('articulo.edit', compact ('articulo', 'categorias', 'subcategorias', 'fabricantes', 'categoria', 'subcategoria', 'fabricante', 'dimensiones'));
	}
	
	public function updateArticulo(/*ArticuloPeticion*/ Request $peticion, $id_articulo)
	{
        $data = json_decode($peticion->data, true);
        $articulo = Articulo::findOrFail($id_articulo);
        if(is_null($articulo)){
            return response()->json('No Existe el Artículo', 400);
        }

        $validator = Validator::make($data, [
            'nombre' => 'required|max:50',
            'codigo' => ['required','max:50', Rule::unique('articulo')->ignore($articulo->codigo, 'codigo')],
            'codigo_barra' => 'required|max:50',
            'precio_compra' => 'required',
            'precio_produccion' => 'required'
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
    public function getArticuloByCodigo($codigo){
        return response()->json((new Articulo)->getArticuloBy('codigo',$codigo));
    }
    public function getArticuloByName($nombre){
        return response()->json((new Articulo)->getArticuloByName($nombre));
    }
    public function getArticuloById($id){
        return response()->json((new Articulo)->getArticuloById($id));
    }
    public function changeStatusOfArticulo(Request $request, $id_articulo){
        $articulo = Articulo::findOrFail($id_articulo);
        $articulo->estatus = !$request->status;
        $articulo->update();
        return response()->json();
    }
}
