<?php

class ConsultastockdetController extends BaseController {

	public function index()
	{
		//filtro de busqueda
		//dd($request->get('marca_id'));
		$mercaderias = Producto::find(0);
	//	$productos = $this->producto->all(); //cambio para mostrar datos
		return View::make('consultastock.consultastockdet', compact('mercaderias'));
	}


	public function filtrar()
	{
		//Si no hay filtro
		//dd(Input::get('provider_id'));
		$tmptot = 0;
		$tmp1 = Input::get('provider_id');
		$tmp2 = Input::get('marca_id');
		$tmp3 = Input::get('tipo_id');
		$tmp4 = Input::get('modelo_id');
		$tmp5 = Input::get('color_id');
		$tmp6 = Input::get('material_id');
		$tmp7 = Input::get('rango_id');
		$tmptot = $tmp1 + $tmp2 + $tmp3 + $tmp4 + $tmp5 + $tmp6 + $tmp7 ;
		
		if( $tmptot == 0 ){

		    $cantidad_locales = DB::table('locals')->count('id');
		    $locals = DB::table('locals')->select('codlocal3')->orderBy('id')->lists('codlocal3');
		    //dd($locals);
		    $expresion = '';
		    $oracion = '';

			for ($i = 1; $i <= $cantidad_locales; $i++) 
	        {
	        	$expresion .= 'COUNT(IF (local_id='.$i.' ,1,NULL)) AS "'. $locals[$i-1].'",';
	        	//$oracion .= '<td>$value->'.  $locals[$i-1] .'</td>';
	        }	
	        $expresion = trim($expresion, ',');
	    	//dd($expresion);
	    	//dd($oracion);
			$sql = "SELECT codproducto31,
										" .$expresion. ", COUNT(codmarca3) AS total
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
			return View::make('consultastock.consultastockdet')->with('mercaderias',$mercaderias);	


		}

       	//Si hay filtros
		    $cantidad_locales = DB::table('locals')->count('id');
		    $locals = DB::table('locals')->select('codlocal3')->orderBy('id')->lists('codlocal3');
		    //dd($locals);
		    $expresion = '';
		    $donde = '';

			for ($i = 1; $i <= $cantidad_locales; $i++) 
	        {
	        	$expresion .= 'COUNT(IF (local_id='.$i.' ,1,NULL)) AS "'. $locals[$i-1].'",';
	        	//$oracion .= '<td>$value->'.  $locals[$i-1] .'</td>';
	        }	
	        $expresion = trim($expresion, ',');
	    	//dd($expresion);
	    	//dd($oracion);



       	$productos = Producto::where('provider_id','>',0);
       	if(Input::get('provider_id')>0)
        	$donde .= ' AND provider_id='.Input::get('provider_id');

       	if(Input::get('marca_id')>0)
        	$donde .= ' AND marca_id='.Input::get('marca_id');

        if(Input::get('tipo_id')>0)
            $donde .= ' AND tipo_id='.Input::get('tipo_id');

        if(Input::get('modelo_id')>0)
            $donde .= ' AND modelo_id='.Input::get('modelo_id');

        if(Input::get('color_id')>0)
            $donde .= ' AND color_id='.Input::get('color_id');

        if(Input::get('material_id')>0)
            $donde .= ' AND material_id='.Input::get('material_id');

        if(Input::get('rango_id')>0)
            $donde .= ' AND rango_id='.Input::get('rango_id');


			$sql = "SELECT codproducto31,
										" .$expresion. ", COUNT(codmarca3) AS total
										from mercaderias 
										INNER JOIN productos ON mercaderias.producto_id=productos.id
										INNER JOIN rangos on productos.rango_id=rangos.id
										INNER JOIN locals ON mercaderias.local_id=locals.id
										inner JOIN marcas on productos.marca_id=marcas.id
										INNER JOIN tipos on productos.tipo_id=tipos.id
										WHERE mercaderias.estado='ACT' " .$donde. "
										GROUP BY marca_id, tipo_id, rango_id, modelo_id, material_id, color_id, talla_id 
										ORDER BY codproducto31";
			//dd($sql);							
	        $mercaderias = DB::select($sql);

        return View::make('consultastock.consultastockdet')->withInput('provider_id', 'marca_id', 'tipo_id', 'modelo_id', 'material_id', 'color_id' , 'rango_id')->with('mercaderias',$mercaderias);		

	}	


}	
?>
