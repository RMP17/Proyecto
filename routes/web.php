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
    return view('auth.login');
});
Route::get('/home', function () {
    return view('maquetas.home');
});

// Funcional aplicacion del middleware de autenticacion

/*Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', function () {
        return view('maquetas.home');
    });
});*/


/*Controladores*/

Route::get('config', 'ConfigController@index');

Route::get('ciudades/{query}', 'CiudadControlador@suggestionsOfCiudades');
Route::get('proveedor/contactos/{id_proveedor}', 'ProveedorControlador@getContactosOfProveedor');
Route::get('proveedores/{query}', 'ProveedorControlador@suggestionsProveedores');
/*Route::put('empleado/update{id_empleado}', 'EmpleadoControlador@updateEmpleado');*/
Route::get('empleado/suggestions/{query}', 'EmpleadoControlador@simpleSuggestionsEmpleado');
Route::get('kardex/{id_empleado}', 'KardexControlador@getKardesEmpleado');
Route::get('contacto/suggestions/{query}', 'ContactoControlador@getContactosForSuggestion');
Route::get('cajas', 'CajaControlador@getCajas');

Route::prefix('cliente')->group(function () {
    Route::get('suggestions/{query}', 'ClienteControlador@suggestionsClients');
    Route::get('nit/{nit}', 'ClienteControlador@getClientByNit');
});

Route::prefix('empresa')->group(function () {
    Route::post('add-suscursal/{id_empresa}', 'EmpresaControlador@addSucursalToEmpresa');
});
Route::prefix('compra')->group(function () {
    Route::get('creditos', 'CompraControlador@getPurchasesOnCreditInForce');
    Route::get('creditos/{id_compra}', 'CompraCreditoController@getCreditoCompra');
    Route::post('credito', 'CompraCreditoController@store');
    Route::post('date_range', 'CompraControlador@getComprasByRageDate');
});
Route::prefix('pais')->group(function () {
    Route::get('query/{query}', 'PaisControlador@searchPais');
    Route::get('id/{id}', 'PaisControlador@getPaisById');
    Route::post('add-ciudad/{id}', 'PaisControlador@addCiudadToPais');
});
Route::prefix('articulo')->group(function () {
    Route::get('all', 'ArticuloControlador@getArticulos');
    Route::put('update/{nombre}', 'ArticuloControlador@updateArticulo');
    Route::get('query/{nombre}', 'ArticuloControlador@getArticuloByName');
    Route::post('precios', 'ArticuloControlador@storePrecios');
    Route::get('precios/{id_articulo}', 'ArticuloControlador@getPreciosArticulo');
    Route::get('codigo/{codigo}', 'ArticuloControlador@getArticuloByCodigo');
    Route::get('id/{id}', 'ArticuloControlador@getArticuloById');
    Route::get('codigo-barras/{codigo_barra}', 'ArticuloControlador@getArticuloByCodigoBarra');
    Route::put('status/{id_articulo}', 'ArticuloControlador@changeStatusOfArticulo');
});
Route::prefix('permiso')->group(function () {
    Route::get('', 'PermisoController@getPermisos');
});


Route::resources([
	'almacen' => 'AlmacenControlador',
	'articulo' => 'ArticuloControlador',
	'acceso' => 'AccesoController',
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
    'venta' => 'VentaControlador',
	'precio' => 'PrecioControlador',
	//'produccion' => 'ProduccionControlador',
	'proveedor' => 'ProveedorControlador',
	'subcategoria' => 'SubcategoriaControlador',
	'sucursal' => 'SucursalControlador',
	/*'kardex' => 'KardexControlador',*/
	'compra' => 'CompraControlador',
	'kardexObservaciones' => 'KardexObservacionesControlador',
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



Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
