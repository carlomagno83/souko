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
	        //dd(count($mercaderias));
	        if ($cantidad_locales==2) $sheet->cells('A1:J2', function($cells) { $cells->setBackground('#81F7F3'); });
	        if ($cantidad_locales==3) $sheet->cells('A1:O2', function($cells) { $cells->setBackground('#81F7F3'); });
	        if ($cantidad_locales==4) $sheet->cells('A1:T2', function($cells) { $cells->setBackground('#81F7F3'); });
	        if ($cantidad_locales==5) $sheet->cells('A1:Y2', function($cells) { $cells->setBackground('#81F7F3'); });
	        if ($cantidad_locales==6) $sheet->cells('A1:AD2', function($cells) { $cells->setBackground('#81F7F3'); });
	        if ($cantidad_locales==7) $sheet->cells('A1:AI2', function($cells) { $cells->setBackground('#81F7F3'); });
	        if ($cantidad_locales==8) $sheet->cells('A1:AN2', function($cells) { $cells->setBackground('#81F7F3'); });
	        if ($cantidad_locales==9) $sheet->cells('A1:AS2', function($cells) { $cells->setBackground('#81F7F3'); });
	        if ($cantidad_locales==10) $sheet->cells('A1:AX2', function($cells) { $cells->setBackground('#81F7F3'); });
	        if ($cantidad_locales==11) $sheet->cells('A1:BC2', function($cells) { $cells->setBackground('#81F7F3'); });
	        if ($cantidad_locales==12) $sheet->cells('A1:BH2', function($cells) { $cells->setBackground('#81F7F3'); });
	        if ($cantidad_locales==13) $sheet->cells('A1:BM2', function($cells) { $cells->setBackground('#81F7F3'); });
	        if ($cantidad_locales==14) $sheet->cells('A1:BR2', function($cells) { $cells->setBackground('#81F7F3'); });

			for($i = 1; $i <= count($mercaderias); $i++)
			{	
			$sheet->setHeight($i,12.75);
		  	}
		        $sheet->loadView('consultastock.kardexxc')->with('mercaderias', $mercaderias);

		    })->download('xls');  

		});

	}



}	
?>
