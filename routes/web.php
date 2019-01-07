<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Vistas*/

Route::get('/', function () {
    return view('maquetas.home');
});

/*
Route::get('/', function () {
    return view('welcome');
});
*/


/*Controladores*/

Route::get('config', 'ConfigController@index');

Route::get('ciudades/{query}', 'CiudadControlador@suggestionsOfCiudades');
Route::get('proveedor/contactos/{id_proveedor}', 'ProveedorControlador@getContactosOfProveedor');
Route::get('proveedores/{query}', 'ProveedorControlador@suggestionsProveedores');

Route::prefix('pais')->group(function () {
    Route::get('query/{query}', 'PaisControlador@searchPais');
    Route::get('id/{id}', 'PaisControlador@getPaisById');
    Route::post('add-ciudad/{id}', 'PaisControlador@addCiudadToPais');
});

Route::prefix('articulo')->group(function () {
    Route::put('update/{nombre}', 'ArticuloControlador@updateArticulo');
    Route::get('query/{nombre}', 'ArticuloControlador@getArticuloByName');
    Route::get('codigo/{codigo}', 'ArticuloControlador@getArticuloByCodigo');
    Route::get('id/{id}', 'ArticuloControlador@getArticuloById');
    Route::get('codigo-barras/{codigo_barra}', 'ArticuloControlador@getArticuloByCodigoBarra');
    Route::put('status/{id_articulo}', 'ArticuloControlador@changeStatusOfArticulo');
});


Route::resources([
	'almacen' => 'AlmacenControlador',
	'articulo' => 'ArticuloControlador',
	'caja' => 'CajaControlador',
	'cajachica' => 'CajaChicaControlador',
	'cargo' => 'CargoControlador',
	'categoria' => 'CategoriaControlador',
	'ciudad' => 'CiudadControlador',
	'cliente' => 'ClienteControlador',
	'contacto' => 'ContactoControlador',
	'cuenta' => 'CuentaControlador',
	'cuenta-proveedor' => 'CuentaProveedorControlador',
	'empleado' => 'EmpleadoControlador',
	'tipoempleado' => 'TipoEmpleadoControlador',
	'empresa' => 'EmpresaControlador',
	'fabricante' => 'FabricanteControlador',
	'gasto' => 'GastoControlador',
	'moneda' => 'MonedaControlador',
	'pais' => 'PaisControlador',
	'precio' => 'PrecioControlador',
	//'produccion' => 'ProduccionControlador',
	'proveedor' => 'ProveedorControlador',
	'subcategoria' => 'SubcategoriaControlador',
	'sucursal' => 'SucursalControlador',
	'venta' => 'VentaControlador',
	'kardex' => 'KardexControlador',
	'compra' => 'CompraControlador',
	'kardexO' => 'KardexObservacionesControlador',
	]);

// Rutas de control con peticiones ajax
Route::get('fabricantes', 'FabricanteControlador@getAllFabricantes');

Route::get('categorias', 'CategoriaControlador@getAllCategorias');

Route::get('almacenes/{id_sucursal}', 'AlmacenControlador@AlmacenesPorSucursal');
Route::get('empleados/{id_sucursal}', 'EmpleadoControlador@EmpleadosPorSucursal');
Route::get('subcategorias/{id_categoria}', 'SubcategoriaControlador@SubcategoriasPorCategoria');
Route::get('sucursales/{id_ciudad}', 'SucursalControlador@SucursalesPorCiudad');


// Rutas de control con parámetros
Route::get('ciudad/create/{id_pais}', 'CiudadControlador@create');
Route::get('cuenta/create/{id_empresa}', 'CuentaControlador@create');
Route::get('cuentaproveedor/create/{id_proveedor}', 'CuentaProveedorControlador@create');
Route::get('gasto/create/{id_caja_chica}', 'GastoControlador@create');
Route::get('subcategoria/create/{id_categoria}', 'SubcategoriaControlador@create');
Route::get('sucursal/create/{id_sucursal}', 'SucursalControlador@create');


