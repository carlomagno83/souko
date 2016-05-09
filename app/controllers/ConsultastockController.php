<?php

class ConsultastockController extends BaseController {

	public function index()
	{
	    $cantidad_locales = DB::table('locals')->count('id');
	    $locals = DB::table('locals')->select('codlocal3')->orderBy('id')->lists('codlocal3');
	    //dd($locals);
	    $expresion = '';
	    //$oracion = '';

		for ($i = 1; $i <= $cantidad_locales; $i++) 
        {
        	$expresion .= 'COUNT(IF (local_id='.$i.' ,1,NULL)) AS "'. $locals[$i-1].'",';
        	//$oracion .= '<td>$value->'.  $locals[$i-1] .'</td>';
        }	
        $expresion = trim($expresion, ',');
    	//dd($expresion);
    	//dd($oracion);

		$sql = "SELECT codmarca3, codtipo8, codrango6,
							" .$expresion. ", COUNT(codmarca3) AS total
							from mercaderias 
							INNER JOIN productos ON mercaderias.producto_id=productos.id
							INNER JOIN rangos on productos.rango_id=rangos.id
							INNER JOIN locals ON mercaderias.local_id=locals.id
							inner JOIN marcas on productos.marca_id=marcas.id
							INNER JOIN tipos on productos.tipo_id=tipos.id
							WHERE mercaderias.estado='ACT' OR mercaderias.estado='INA'
							GROUP BY  marca_id, tipo_id, rango_id
							ORDER BY desmarca, destipo, codrango6,deslocal";

		//dd($sql);							
        $mercaderias = DB::select($sql);
        //dd($mercaderias);

		return View::make('consultastock.consultastock')->with('mercaderias', $mercaderias);
	}


	public function descargaexcel()
	{


		Excel::create(date('Y-m-d').'stock_actual_adm', function($excel) {

		    $excel->sheet('Hoja1', function($sheet) {

		    $cantidad_locales = DB::table('locals')->count('id');
		    $locals = DB::table('locals')->select('codlocal3')->orderBy('id')->lists('codlocal3');
		    //dd($locals);
		    $expresion = '';
		    //$oracion = '';

			for ($i = 1; $i <= $cantidad_locales; $i++) 
	        {
	        	$expresion .= 'COUNT(IF (local_id='.$i.' ,1,NULL)) AS "'. $locals[$i-1].'",';
	        	//$oracion .= '<td>$value->'.  $locals[$i-1] .'</td>';
	        }	
	        $expresion = trim($expresion, ',');
	    	//dd($expresion);
	    	//dd($oracion);

			$sql = "SELECT codmarca3, codtipo8, codrango6,
								" .$expresion. ", COUNT(codmarca3) AS total
								from mercaderias 
								INNER JOIN productos ON mercaderias.producto_id=productos.id
								INNER JOIN rangos on productos.rango_id=rangos.id
								INNER JOIN locals ON mercaderias.local_id=locals.id
								inner JOIN marcas on productos.marca_id=marcas.id
								INNER JOIN tipos on productos.tipo_id=tipos.id
								WHERE mercaderias.estado='ACT' OR mercaderias.estado='INA'
								GROUP BY  marca_id, tipo_id, rango_id
								ORDER BY desmarca, destipo, codrango6,deslocal";

			//dd($sql);							
	        $mercaderias = DB::select($sql);
				$sheet->freezeFirstRow();	
				
				$sheet->cells('B1:Z1', function($cells) { $cells->setAlignment('right'); });
		        $sheet->loadView('consultastock.consultastockxc')->with('mercaderias', $mercaderias);

		    })->download('xls');  

		});

	}


	public function descargaexcelkardex()
	{


		Excel::create(date('Y-m-d').'kardex_actual_adm', function($excel) {

		    $excel->sheet('Hoja1', function($sheet) {

			$sql = "SELECT fechadocumento, desusuario, codlocal3, movimientos.mercaderia_id, codproducto31, 
						productos.precioventa as sugerido, 
						 mercaderias.precioventa,
						(mercaderias.precioventa-productos.precioventa) as diferencia
						from movimientos
						INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
						INNER JOIN mercaderias ON movimientos.mercaderia_id=mercaderias.id
						INNER JOIN productos ON mercaderias.producto_id=productos.id
						INNER JOIN users ON mercaderias.usuario_id=users.id
						INNER JOIN locals ON mercaderias.local_id=locals.id
						WHERE fechadocumento = DATE_SUB(CONCAT(CURDATE(), ' 00:00:00'), 
INTERVAL 1 DAY) AND movimientos.tipomovimiento_id=3
						ORDER BY desusuario, codlocal3";

			//dd($sql);							
	        $mercaderias = DB::select($sql);
//dd($mercaderias[1]->fechadocumento);
	        $sheet->freezeFirstRow();
	        $sheet->cells('A1:H1', function($cells) { $cells->setBackground('#81F7F3'); });
			/*for($i = 1; $i <= count($mercaderias)+5; $i++)
			{	
			$sheet->setHeight($i, 5);
		  	}*/
		        $sheet->loadView('consultastock.diferenciaxc')->with('mercaderias', $mercaderias);

		    });

//kardex
		    $excel->sheet('Hoja2', function($sheet) {

		    $cantidad_locales = DB::table('locals')->count('id');
		    $locals = DB::table('locals')->select('codlocal3')->orderBy('id')->lists('codlocal3');
		    //dd($locals);
		    $expresion = '';
		    //$oracion = '';

			for ($i = 1; $i <= $cantidad_locales; $i++) 
	        {
	        	$expresion .= 'COUNT(IF (local_id='.$i.' ,1,NULL)) AS "'. $locals[$i-1].'",';
	        	//$oracion .= '<td>$value->'.  $locals[$i-1] .'</td>';
	        }	
	        $expresion = trim($expresion, ',');
	    	//dd($expresion);
	    	//dd($oracion);

			$sql = "SELECT codmarca3, marca_id, codtipo8, tipo_id, codrango6, rango_id,
								" .$expresion. "
								from mercaderias 
								INNER JOIN productos ON mercaderias.producto_id=productos.id
								INNER JOIN rangos on productos.rango_id=rangos.id
								INNER JOIN locals ON mercaderias.local_id=locals.id
								inner JOIN marcas on productos.marca_id=marcas.id
								INNER JOIN tipos on productos.tipo_id=tipos.id
								WHERE mercaderias.estado='ACT' OR mercaderias.estado='INA'
								GROUP BY  marca_id, tipo_id, rango_id
								ORDER BY desmarca, destipo, codrango6,deslocal";

			//dd($sql);							
	        $mercaderias = DB::select($sql);

			for($i = 1; $i <= count($mercaderias)+20; $i++)
			{	
			$sheet->setHeight($i, 15);
		  	}
		  	$sheet->cells('A1:B1', function($cells) { $cells->setBackground('#FFFFFF'); });
		        $sheet->loadView('consultastock.kardexxc')->with('mercaderias', $mercaderias);

		    });

			
		})->download('xls');;

	}



}	
?>
