<?php

class InventarioController extends BaseController {

	protected $mercaderia;

	public function __construct(Mercaderia $mercaderia)
	{
		$this->mercaderia = $mercaderia;
	}



	public function index()
	{

		return View::make('inventario.inventario');  
	}

	public function inventarioarchivo()
	{
		$input = Input::all();
		//dd(Input::get('local_id'));
		//$local_id = Input::get('local_id');
		$codlocal3 = DB::table('locals')->select('codlocal3')->where('id','=', Input::get('local_id'))->pluck('codlocal3');



		Excel::create(date('Y-m-d').'inventario_'.$codlocal3, function($excel) {

		    $excel->sheet('Hoja1', function($sheet) {

		    $local_id = Input::get('local_id');

			$sql = "SELECT mercaderias.id, codproducto31, codmarca3, codtipo8, codrango6
								from mercaderias 
								INNER JOIN productos ON mercaderias.producto_id=productos.id
								INNER JOIN marcas ON productos.marca_id=marcas.id
								INNER JOIN tipos ON productos.tipo_id=tipos.id
								INNER JOIN rangos ON productos.rango_id=rangos.id
								WHERE mercaderias.local_id=$local_id AND (mercaderias.estado='ACT' OR mercaderias.estado='INA')
								ORDER BY codmarca3, codtipo8, codrango6";		
								
	        $mercaderias = DB::select($sql);


		        $sheet->loadView('inventario.inventarioxc')->with('mercaderias', $mercaderias);

		    })->download('xls');  

		});


		return View::make('inventario.inventarioxc')->withErrors(['Archivo creado ...']);;	


	}

 

	

}
