<?php

class GuiacuadernoController extends BaseController {

	protected $mercaderia;

	public function __construct(Mercaderia $mercaderia)
	{
		$this->mercaderia = $mercaderia;
	}



	public function index()
	{

		return View::make('guiacuaderno.guiacuaderno');  
	}


	public function descargar()
	{
		$input = Input::all();
		//dd($input);
		//$local_id = Input::get('local_id');
		$codlocal3 = DB::table('locals')->select('codlocal3')->where('id','=', Input::get('local_id'))->pluck('codlocal3');



		Excel::create('Kardex_la_quinta_'.date('Y-m-d').$codlocal3, function($excel) {

		    $excel->sheet('Guias', function($sheet) {

		    $fecini = Input::get('fecini');
		    $fecfin = Input::get('fecfin');
		    $sheet->freezeFirstRow();

			$sql = "SELECT documentos.id, documentos.localini_id, 
				IF(documentos.tipomovimiento_id=1, 'COMPRAS', loc1.codlocal3) AS origen,
				documentos.tipomovimiento_id,
				documentos.fechadocumento, numdocfisico,
				documentos.localfin_id,
				IF(documentos.tipomovimiento_id=7 and documentos.flagestado='BAJ', pro1.desprovider, 
					IF(documentos.tipomovimiento_id=7 and documentos.flagestado='ACT','STAND BY',loc2.codlocal3)) AS destino,
				COUNT(movimientos.documento_id) AS cantidad,
				marca_id, tipo_id, rango_id, codmarca3, codtipo8, codrango6,
				AVG(mercaderias.preciocompra) as pcompra

				from movimientos
				INNER JOIN  mercaderias on mercaderias.id=movimientos.mercaderia_id
				INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
				INNER JOIN productos ON productos.id=mercaderias.producto_id
				LEFT OUTER JOIN marcas ON marcas.id=productos.marca_id
				LEFT OUTER JOIN tipos ON tipos.id=productos.tipo_id
				LEFT OUTER JOIN rangos ON rangos.id=productos.rango_id

				LEFT OUTER JOIN locals loc1 ON loc1.id=documentos.localini_id
				LEFT OUTER JOIN locals loc2 ON loc2.id=documentos.localfin_id
				LEFT OUTER JOIN providers pro1 ON pro1.id=documentos.localfin_id
				WHERE documentos.tipomovimiento_id<>3 AND fechadocumento>='" .$fecini. "' AND fechadocumento<='" .$fecfin. "' 
				GROUP BY documentos.id, documentos.tipomovimiento_id, marca_id, tipo_id, rango_id
				ORDER BY fechadocumento, documentos.tipomovimiento_id, documentos.id";		
//dd($sql);							
	        $mercaderias = DB::select($sql);

//dd($mercaderias);
		        $sheet->loadView('guiacuaderno.guiaxc')->with('mercaderias', $mercaderias);

		    });



		    $excel->sheet('Cuadernos', function($sheet) {

		    $fecini = Input::get('fecini');
		    $fecfin = Input::get('fecfin');
		    $sheet->freezeFirstRow();

			$sql = "SELECT documentos.id, movimientos.tipomovimiento_id, 
				fechadocumento, desusuario,
				documentos.localfin_id, 
				locals.codlocal3,
				mercaderias.id as merca_id,
				 codmarca3, codtipo8, codrango6, 
				IF(movimientos.devolucion=0, mercaderias.precioventa, movimientos.devolucion) AS venta,
				IF(movimientos.devolucion=0, mercaderias.preciocompra, movimientos.devolucion) AS compra,
				IF(movimientos.devolucion=0, mercaderias.precioventa, movimientos.devolucion) -
				IF(movimientos.devolucion=0, mercaderias.preciocompra, movimientos.devolucion) AS ganancia

				FROM movimientos 
				INNER JOIN  mercaderias on mercaderias.id=movimientos.mercaderia_id
				INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
				INNER JOIN productos ON productos.id=mercaderias.producto_id
				INNER JOIN marcas ON marcas.id=productos.marca_id
				INNER JOIN tipos ON tipos.id=productos.tipo_id
				INNER JOIN rangos ON rangos.id=productos.rango_id
				INNER JOIN locals ON locals.id=documentos.localini_id

				INNER JOIN users ON users.id=mercaderias.usuario_id
				WHERE movimientos.tipomovimiento_id=3 AND fechadocumento>='" .$fecini. "' AND fechadocumento<='" .$fecfin. "' 
				ORDER BY fechadocumento, movimientos.documento_id";		
//dd($sql);							
	        $mercaderias = DB::select($sql);

//dd($mercaderias);
		        $sheet->loadView('guiacuaderno.cuadernoxc')->with('mercaderias', $mercaderias);

		    })->download('xls');  

		});


		return View::make('guiacuaderno.guiacuaderno')->withErrors(['Archivo creado ...']);;	


	}

 

	

}
