<?php

Route::get('/', function()
{
    return View::make('layouts.scaffold');
});

Route::get('layout-old', function()
{
    return View::make('index');
});


//Maestros
Route::resource('colors', 'ColorsController');
Route::resource('locals', 'LocalsController');
Route::resource('estados', 'EstadosController');
Route::resource('marcas', 'MarcasController');
Route::resource('tipos', 'TiposController');
Route::resource('modelos', 'ModelosController');
Route::resource('materials', 'MaterialsController');
Route::resource('rangos', 'RangosController');
Route::resource('tallas', 'TallasController');
Route::resource('tipomovimientos', 'TipomovimientosController');
Route::resource('documentos', 'DocumentosController');
Route::resource('productos', 'ProductosController');
Route::get('productos-index', 'ProductosController@index');//filtros para busqueda de producto
Route::any('productos-filtrar', 'ProductosController@filtrar');
Route::resource('users', 'UsersController');
Route::resource('providers', 'ProvidersController');

Route::resource('mercaderias', 'MercaderiasController');
Route::resource('movimientos', 'MovimientosController');

//Operaciones
Route::get('ingresos-proveedor', 'IngresoproveedorController@index');
Route::any('ingresos-proveedor-create', 'IngresoproveedorController@create');
Route::post('ingresos-proveedor-store', 'IngresoproveedorController@store');

Route::get('eliminacionguia', 'EliminacionguiaController@index');
Route::any('eliminacionguia-create', 'EliminacionguiaController@create');
Route::post('eliminacionguia-store', 'EliminacionguiaController@store');


Route::resource('trasladoalmacpto', 'TrasladoalmacptoController');
Route::resource('trasladoptopto', 'TrasladoptoptoController');
Route::resource('ventas', 'VentasController');
Route::resource('devolucionproveedor', 'DevolucionproveedorController');
Route::resource('generaguiadev', 'GeneraguiadevController');
Route::resource('liquidacionguiadev', 'LiquidacionguiadevController');
Route::resource('devolucionptoventa', 'DevolucionptoventaController');

//Reportes
Route::any('reporte-muestra', 'ReporteingresoController@getmuestra');
/*
Route::resource('reporteingreso', 'ReporteingresoController');
Route::resource('reporteventa', 'ReporteventaController');
Route::resource('reportestock', 'ReportestockController');
*/

/*Auth*/
Route::get('login', 'AuthController@showLogin'); // Mostrar login
Route::post('login', 'AuthController@postLogin'); // Verificar datos
Route::get('logout', 'AuthController@logOut'); // Finalizar sesión

/*Rutas privadas solo para usuarios autenticados*/ //Comentado para que no estorbe
/*Route::group(['before' => 'auth'], function()
{
    Route::get('/', function(){return View::make('index');});
	Route::resource('colors', 'ColorsController');
	Route::resource('locals', 'LocalsController');
	Route::resource('estados', 'EstadosController');
	Route::resource('marcas', 'MarcasController');
	Route::resource('tipos', 'TiposController');
	Route::resource('modelos', 'ModelosController');
	Route::resource('materials', 'MaterialsController');
	Route::resource('rangos', 'RangosController');
	Route::resource('tallas', 'TallasController');
	Route::resource('tipomovimientos', 'TipomovimientosController');
	Route::resource('documentos', 'DocumentosController');
	Route::resource('productos', 'ProductosController');
	Route::resource('users', 'UsersController');
	Route::resource('providers', 'ProvidersController');
	//Operaciones
	Route::resource('mercaderias', 'MercaderiasController');
	Route::resource('movimientos', 'MovimientosController');
	Route::resource('ingresoproveedor', 'IngresoproveedorController');
	Route::resource('confirmacioningreso', 'confirmacioningresoController');
	Route::resource('trasladoalmacpto', 'TrasladoalmacptoController');
	Route::resource('trasladoptopto', 'TrasladoptoptoController');
	Route::resource('ventas', 'VentasController');
	Route::resource('devolucionproveedor', 'DevolucionproveedorController');
	Route::resource('generaguiadev', 'GeneraguiadevController');
	Route::resource('liquidacionguiadev', 'LiquidacionguiadevController');
	Route::resource('devolucionptoventa', 'DevolucionptoventaController');

	//Reportes
	Route::resource('reporteingreso', 'ReporteingresoController');
	Route::resource('reporteventa', 'ReporteventaController');
	Route::resource('reportestock', 'ReportestockController');

});
*/

/*
Route::get('ingresoproveedor', 'IngresoproveedorController@ingreso');
Route::post('ingresoproveedor', 'IngresoproveedorController@graba');

Route::get('trasladoalmacpto', 'TrasladoalmacptoController@ingreso');

Route::get('trasladoptopto', 'TrasladoptoptoController@ingreso');

Route::get('ventas', 'VentasController@ingreso');

Route::get('devolucionproveedor', 'DevolucionproveedorController@ingreso');

Route::get('generaguiadev', 'GeneraguiadevController@ingreso');

Route::get('liquidacionguiadev', 'liquidacionguiadevController@ingreso');
*/

