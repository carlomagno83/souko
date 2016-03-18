<?php

class ReportestockController extends BaseController {

	public function index()
	{
	    $cantidad_locales = DB::table('locals')->count('id');
	    $locals = DB::table('locals')->select('codlocal3')->orderBy('id')->lists('codlocal3');
	    //dd($locals);
	    $expresion = '';
	    $oracion = '';

		for ($i = 1; $i <= $cantidad_locales; $i++) 
        {
        	$expresion .= 'COUNT(IF (local_id='.$i.' ,1,NULL)) AS '. $locals[$i-1].',';
        	//$oracion .= '<td>$value->'.  $locals[$i-1] .'</td>';
        }	
        $expresion = trim($expresion, ',');
    	//dd($expresion);
    	//dd($oracion);
		$sql = "SELECT codproducto31,
									" .$expresion. "
									from mercaderias 
									INNER JOIN productos ON mercaderias.producto_id=productos.id
									INNER JOIN rangos on productos.rango_id=rangos.id
									INNER JOIN locals ON mercaderias.local_id=locals.id
									inner JOIN marcas on productos.marca_id=marcas.id
									INNER JOIN tipos on productos.tipo_id=tipos.id
									WHERE mercaderias.estado='ACT'
									GROUP BY marca_id, tipo_id, rango_id, modelo_id, material_id, color_id, talla_id 
									ORDER BY codproducto31";
		//dd($sql);							
        $mercaderias = DB::select($sql);

        $sql2 = "SELECT " .$expresion. "
									from mercaderias 
									INNER JOIN productos ON mercaderias.producto_id=productos.id
									WHERE mercaderias.estado='ACT'
									ORDER BY codproducto31";
		$totales = DB::select($sql2);

		return View::make('reportestock.reportestock')->with('mercaderias', $mercaderias)->with('totales', $totales);
	}



	public function descargaexcel()
	{


		Excel::create(date('Y-m-d').'stock_actual', function($excel)
		{
			$excel->sheet('Hoja1', function($sheet) 
			{


			    $cantidad_locales = DB::table('locals')->count('id');
			    $locals = DB::table('locals')->select('codlocal3')->orderBy('id')->lists('codlocal3');
			    $locals_id = DB::table('locals')->select('id')->orderBy('id')->lists('id');
			    //dd($locals[0]);
			    $expresion = '';
			    $titulo = '';

				for ($i = 1; $i <= $cantidad_locales; $i++) 
		        {
		        	$expresion .= 'COUNT(IF (local_id='.$i.' ,1,NULL)) AS '. $locals[$i-1].',';
		        	//$expresion .= 'COUNT(IF (local_id='.$i.' ,1,NULL)) AS '. $locals_id[$i-1].',';
		        	$titulo .= '"'.$locals[$i-1] .'",';
		        }	
		        $expresion = trim($expresion, ',');
		        $titulo = trim($titulo, ',');
		        //$titulo = 'array("Código mercadería",'.$titulo .')';
				//$titulo = '"Código mercadería",'.$titulo ;
		    	$titulo = 'row(1, array("Código mercadería",'.$titulo.'))' ;
		    	//dd($expresion);
		    	//dd($titulo);
				$sql = "SELECT codproducto31,
											" .$expresion. "
											from mercaderias 
											INNER JOIN productos ON mercaderias.producto_id=productos.id
											INNER JOIN rangos on productos.rango_id=rangos.id
											INNER JOIN locals ON mercaderias.local_id=locals.id
											inner JOIN marcas on productos.marca_id=marcas.id
											INNER JOIN tipos on productos.tipo_id=tipos.id
											WHERE mercaderias.estado='ACT'
											GROUP BY marca_id, tipo_id, rango_id, modelo_id, material_id, color_id, talla_id 
											ORDER BY codproducto31";
				//dd($sql);							
		        $mercaderias = DB::select($sql);

		        //dd($mercaderias);
				//$sheet->loadView('reportestock.reportestock', ['mercaderias' => $mercaderias->toArray()]);
			
		        //$sheet->row(1, array($titulo));
				//$sheet->row(1, array("Código mercadería"));
				$sheet->$titulo  ;




	        	//$sheet->row(1, array("Código mercadería",$locals[$i-1],$locals[$i],$locals[$i+1],$locals[$i+2]));
		        
		        //$sheet->row(1, array("Código mercadería",$locals[0],$locals[1],$locals[2],$locals[3]));
		        
		


	        });

			
		})->download('xls');
	}
}	
?>
