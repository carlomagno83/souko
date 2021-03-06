<?php

/*   Route::get('/', function()
{
    return View::make('layouts.scaffold');
});

Route::get('layout-old', function()
{
    return View::make('index');
});  */
//dd(Auth::user()->exists);

/*Auth*/
Route::get('login', 'AuthController@showLogin'); // Mostrar login
Route::post('login', 'AuthController@postLogin'); // Verificar datos
Route::get('logout', 'AuthController@logOut'); // Finalizar sesión

/*Rutas privadas solo para usuarios autenticados*/ 
if (Auth::check())
{	
	Route::group(['before' => 'auth'], function()
	{
	    //Route::get('/', function(){return View::make('layouts.scaffold');});
	    Route::get('/', function(){return View::make('layouts.scaffold');});
	    Route::get('login', 'AuthController@showLogin'); // Mostrar login
		Route::post('login', 'AuthController@postLogin'); // Verificar datos
		Route::get('logout', 'AuthController@logOut');

	    if( Auth::user()->rolusuario=='VENDE' )
	    {
			Route::resource('reportestock', 'ReportestockController');
			Route::get('descargaexcel', 'ReportestockController@descargaexcel');
		}

	    if( Auth::user()->rolusuario=='SUPER' or  Auth::user()->rolusuario=='ADMIN')
	    {
		//Maestros
			if( Auth::user()->rolusuario=='SUPER')
			{
				
				Route::resource('locals', 'LocalsController');
				Route::resource('estados', 'EstadosController');
				Route::resource('marcas', 'MarcasController');
				Route::resource('tipos', 'TiposController');
				
				Route::resource('materials', 'MaterialsController');
				Route::resource('rangos', 'RangosController');
				Route::resource('tallas', 'TallasController');
				Route::resource('tipomovimientos', 'TipomovimientosController');
				Route::resource('documentos', 'DocumentosController');
				Route::resource('users', 'UsersController');
				Route::resource('usersactivar', 'UsersController@activar');
				Route::get('cambiarestado/{usuario_id}', 'UsersController@cambiarestado');
				Route::resource('providers', 'ProvidersController');				
			}	
Route::resource('colors', 'ColorsController');
Route::resource('modelos', 'ModelosController');

			Route::resource('productos', 'ProductosController');
			Route::get('productos-index', 'ProductosController@index');//filtros para busqueda de producto
			Route::any('productos-filtrar', 'ProductosController@filtrar');
			Route::any('editabloque', 'ProductosController@editabloque');
			Route::get('productos/destruye/{id}', 'ProductosController@destruye');

			Route::resource('mercaderias', 'MercaderiasController');
			Route::resource('mercaderias-filtrar', 'MercaderiasController@filtrar');

			Route::resource('movimientos', 'MovimientosController');


			//Operaciones
			Route::get('ingresos-proveedor', 'IngresoproveedorController@index');
			Route::any('ingresos-proveedor-create', 'IngresoproveedorController@index');
			Route::post('ingresos-proveedor-store', 'IngresoproveedorController@store');
			Route::any('ingresos-proveedor-filtrar', 'IngresoproveedorController@filtrar');
			Route::any('ingresos-proveedor-agregar', 'IngresoproveedorController@agregar');
			Route::get('ingresoproveedor/delete/{producto_id}', 'IngresoproveedorController@getDelete');

			Route::get('eliminacionguia', 'EliminacionguiaController@index');
			Route::any('eliminacionguia-create', 'EliminacionguiaController@create');
			Route::any('eliminacionguia-createfisico', 'EliminacionguiaController@createfisico');
			Route::post('eliminacionguia-store', 'EliminacionguiaController@store');

			Route::get('reimprimeguiaentrada', 'ReimprimeguiaentradaController@index');
			Route::any('reimprimeguiaentrada-buscar', 'ReimprimeguiaentradaController@buscar');
			Route::any('reimprimeguiaentrada-buscarfisico', 'ReimprimeguiaentradaController@buscarfisico');
			Route::post('reimprimeguiaentrada-reimprime', 'ReimprimeguiaentradaController@reimprime');

			Route::get('trasladoalmacpto', 'TrasladoalmacptoController@index');
			Route::any('trasladoalmacpto-agregareg', 'TrasladoalmacptoController@agregareg');
			Route::post('trasladoalmacpto-store', 'TrasladoalmacptoController@store');
			Route::get('trasladoalmacpto/delete/{mercaderia_id}','TrasladoalmacptoController@getDelete');

			Route::get('trasladoptopto', 'TrasladoptoptoController@index');
			Route::any('trasladoptopto-agregareg', 'TrasladoptoptoController@agregareg');
			Route::post('trasladoptopto-store', 'TrasladoptoptoController@store');
			Route::get('trasladoptopto/delete/{mercaderia_id}','TrasladoptoptoController@getDelete');

			Route::get('ventas', 'VentasController@index');
			Route::any('ventas-agregareg', 'VentasController@agregareg');
			Route::post('ventas-store', 'VentasController@store');
			Route::get('ventas/delete/{mercaderia_id}','VentasController@getDelete');

			Route::get('devolucionptoventa', 'DevolucionptoventaController@index');
			Route::any('devolucionptoventa-agregareg', 'DevolucionptoventaController@agregareg');
			Route::post('devolucionptoventa-store', 'DevolucionptoventaController@store');
			Route::get('devolucionptoventa/delete/{mercaderia_id}','DevolucionptoventaController@getDelete');

			Route::get('generaguiadev', 'GeneraguiadevController@index');
			Route::any('generaguiadev-filtrar', 'GeneraguiadevController@filtrar');
			Route::any('generaguiadev-agregareg', 'GeneraguiadevController@agregareg');
			Route::post('generaguiadev-store', 'GeneraguiadevController@store');
			Route::get('generaguiadev/delete/{mercaderia_id}','GeneraguiadevController@getDelete');

			Route::get('liquidacionguiadev', 'LiquidacionguiadevController@index');
			Route::post('liquidacionguiadev-store', 'LiquidacionguiadevController@store');

			Route::resource('cambioestado', 'CambioestadoController');
			Route::post('cambioestado-store', 'CambioestadoController@store');
			Route::get('cambioestado/delete/{mercaderia_id}','CambioestadoController@getDelete');
			Route::any('cambioestado-agregareg', 'CambioestadoController@agregareg');			

			//Reportes
			Route::resource('reporteingreso', 'ReporteingresoController');
			
			Route::resource('inventario', 'InventarioController');
			Route::post('inventario-crear-archivo', 'InventarioController@inventarioarchivo');

			Route::resource('consultaventa', 'ConsultaventaController');
			Route::post('consultaventabuscar', 'ConsultaventaController@buscar');

			Route::resource('consultastockadm', 'ConsultastockController');
			Route::get('descargaexcelstockadm', 'ConsultastockController@descargaexcel');
			Route::get('descargaexcelkardex', 'ConsultastockController@descargaexcelkardex');			
			Route::get('pantallaexcelkardexdescanso', 'ConsultastockController@pantallaexcelkardexdescanso');			
			Route::get('descargaexcelkardexdescanso', 'ConsultastockController@descargaexcelkardexdescanso');			
						

			Route::resource('consultastockdet', 'ConsultastockdetController');
			Route::any('consulta-productos-filtrar', 'ConsultastockdetController@filtrar');

			Route::resource('reportestock', 'ReportestockController');
			Route::get('descargaexcel', 'ReportestockController@descargaexcel');

			Route::resource('consultastockhist', 'ConsultastockhistController');
			Route::post('consulta-stock-historico', 'ConsultastockhistController@consulta');

			Route::resource('consultastockhistdet', 'ConsultastockhistdetController');
			Route::post('consulta-stock-historico-det', 'ConsultastockhistdetController@consulta');

			Route::resource('consultamerca', 'ConsultamercaController');	
			Route::post('consultamercaderia', 'ConsultamercaController@consulta');

			Route::resource('consultadocs', 'ConsultadocsController');			
			Route::post('consulta-docs', 'ConsultadocsController@consulta');
			Route::post('consulta-docs-editar', 'ConsultadocsController@editar');

			Route::get('consultadocs/detalle1/{doc_id}', 'ConsultadocsController@detalle1');
			Route::get('consultadocs/detalle2/{doc_id}', 'ConsultadocsController@detalle2');
			Route::get('consultadocs/detalle3/{doc_id}', 'ConsultadocsController@detalle3');
			Route::get('consultadocs/detalle4/{doc_id}', 'ConsultadocsController@detalle4');
			Route::get('consultadocs/detalle6/{doc_id}', 'ConsultadocsController@detalle6');
			Route::get('consultadocs/detalle7/{doc_id}', 'ConsultadocsController@detalle7');
			Route::post('eliminaguiaventa', 'ConsultadocsController@eliminaguiaventa');			

			//reportes especiales y correciones
			if( Auth::user()->rolusuario=='SUPER')
			{
				//reportes especiales


				Route::resource('gananciabruta', 'GananciabrutaController');
				Route::post('gananciabrutabuscar', 'GananciabrutaController@buscar');

				Route::resource('flujoventa', 'FlujoventaController');
				Route::post('consulta-stock-historico', 'ConsultastockhistController@consulta');

				Route::resource('guiacuaderno', 'GuiacuadernoController');
				Route::post('guiacuaderno-descargar', 'GuiacuadernoController@descargar');

				Route::resource('stockafecha', 'StockafechaController');
				Route::post('stockafecha-consultar', 'StockafechaController@consultar');
				Route::post('stockafecha-descargar', 'StockafechaController@descargar');

				Route::resource('buscaincomp', 'BuscaincompController');
				Route::post('buscaincomp-consultar', 'StockafechaController@consultar');


				// correciones
				Route::get('documentoeditar', 'DocumentoeditarController@index');
				Route::post('documentoeditar-buscar', 'DocumentoeditarController@buscar');
				Route::post('documentoeditardocumento', 'DocumentoeditarController@documentoeditardocumento');

				Route::get('registroagregar', 'RegistroagregarController@index');
				Route::post('agregaregistro-buscar', 'RegistroagregarController@buscar');

				Route::post('registroagregarventa', 'RegistroagregarController@registroagregarventa');
				Route::post('registroagregartrasladoalm', 'RegistroagregarController@registroagregartrasladoalm');
				Route::post('registroagregartrasladopto', 'RegistroagregarController@registroagregartrasladopto');
				Route::post('registroagregardevolucionprov', 'RegistroagregarController@registroagregardevolucionprov');

				Route::get('registroeliminar', 'RegistroeliminarController@index');
				Route::post('eliminaregistro-buscar', 'RegistroeliminarController@buscar');	

				Route::post('registroeliminarregistro', 'RegistroeliminarController@registroeliminarregistro');

				Route::get('registroeditar', 'RegistroeditarController@index');
				Route::post('editaregistro-buscar', 'RegistroeditarController@buscar');
				Route::post('registroeditarventa', 'RegistroeditarController@registroeditarventa');

				Route::get('ingresoeditar', 'IngresoeditarController@index');
				Route::post('ingresoeditar-buscar', 'IngresoeditarController@buscar');
				Route::post('ingresoeditarcompra', 'IngresoeditarController@ingresoeditarcompra');				
			}

			Route::resource('movimientocosto', 'MovimientocostoController');
			Route::post('movimientocostobuscar', 'MovimientocostoController@buscar');

			Route::get('consultamercaderia/{cod}', 'RegistroagregarController@consultamercaderia');
			Route::post('imprimeetiqueta', 'RegistroagregarController@imprimeetiqueta');

			//mantenimiento
			Route::resource('mantenimientobd', 'mantenimientobdController@mantenimientobd');

			//Batch Pull
			Route::get('batch', function(){

				//exec("git pull https://carlomagno83:locojiju1@github.com/carlomagno83/souko.git master 2>&1",$output, $return_var);
				//exec('ls 2>&1',$output, $return_var);
				//exec("git pull https://carlomagno83:locojiju1@github.com/carlomagno83/souko.git master 2>&1",$output, $return_var);				
				exec('git pull 2>&1',$output, $return_var);
				var_dump($output);
				var_dump($return_var);				
				
			});

			Route::get('test-batch', function(){

				return 'test10';

			});

		}
	});
}
else
{
Route::get('/','AuthController@showLogin');
}
//oute::get('login', 'AuthController@showLogin'); // Mostrar login

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

?>