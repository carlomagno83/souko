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
        	$expresion .= 'COUNT(IF (local_id='.$i.' ,1,NULL)) AS '. $locals[$i-1].',';
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
							WHERE mercaderias.estado='ACT'
							GROUP BY  marca_id, tipo_id, rango_id
							ORDER BY desmarca, destipo, codrango6,deslocal";

		//dd($sql);							
        $mercaderias = DB::select($sql);
        //dd($mercaderias);

		return View::make('consultastock.consultastock')->with('mercaderias', $mercaderias);
	}



}	
?>
