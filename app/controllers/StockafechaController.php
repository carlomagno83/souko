<?php

class StockafechaController extends BaseController {

	protected $mercaderia;

	public function __construct(Mercaderia $mercaderia)
	{
		$this->mercaderia = $mercaderia;
	}



	public function index()
	{
		$mercaderias = Mercaderia::find(0);
		return View::make('stockafecha.stockafecha')->with('mercaderias',$mercaderias);  
	}


	public function consultar()
	{

		$fec = Input::get('fecini');
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

		$sql = "SELECT codmarca3, codtipo8, codrango6, marca_id, tipo_id, rango_id,
				" .$expresion. ", 
				COUNT(codmarca3) AS total

				from mercaderias 
				INNER JOIN productos ON mercaderias.producto_id=productos.id
				INNER JOIN rangos on productos.rango_id=rangos.id
				INNER JOIN locals ON mercaderias.local_id=locals.id
				inner JOIN marcas on productos.marca_id=marcas.id
				INNER JOIN tipos on productos.tipo_id=tipos.id

				WHERE mercaderias.estado='ACT' OR mercaderias.estado='INA'
				GROUP BY  marca_id, tipo_id, rango_id
				ORDER BY desmarca, destipo, codrango6, deslocal";


//		dd($sql);							
		$mercaderias = DB::select($sql);

$expresion = '- COUNT(IF (movimientos.tipomovimiento_id=1 and documentos.localfin_id=1 ,movimientos.mercaderia_id,NULL))
+ COUNT(IF (movimientos.tipomovimiento_id=2 and documentos.localini_id=1 ,movimientos.mercaderia_id,NULL)) 
- COUNT(IF (movimientos.tipomovimiento_id=6, movimientos.mercaderia_id,null)) 

+ COUNT(IF (movimientos.tipomovimiento_id=7, movimientos.mercaderia_id,null)) 
AS ALM,';
for ($i = 2; $i <= $cantidad_locales; $i++) 
{
	$expresion .= '
- COUNT(IF (movimientos.tipomovimiento_id=2 and documentos.localfin_id='.$i.', movimientos.mercaderia_id,NULL)) 
- COUNT(IF (movimientos.tipomovimiento_id=4 and documentos.localfin_id='.$i.', movimientos.mercaderia_id,NULL))
+ COUNT(IF (movimientos.tipomovimiento_id=4 and documentos.localini_id='.$i.', movimientos.mercaderia_id,NULL)) 
+ COUNT(IF (movimientos.tipomovimiento_id=3 and documentos.localfin_id='.$i.' and devolucion>=0, movimientos.mercaderia_id,null)) 
- COUNT(IF (movimientos.tipomovimiento_id=3 and documentos.localfin_id='.$i.'  and devolucion<0, movimientos.mercaderia_id,null)) 
+ COUNT(IF (movimientos.tipomovimiento_id=6 and documentos.localini_id='.$i.' , movimientos.mercaderia_id,null)) AS "'. $locals[$i-1].'",';
	//$oracion .= '<td>$value->'.  $locals[$i-1] .'</td>';
}	
$expresion = trim($expresion, ',');
$sql = "SELECT codmarca3, codtipo8, codrango6, marca_id, tipo_id, rango_id,
" .$expresion. "
FROM movimientos 
INNER JOIN mercaderias on mercaderias.id=movimientos.mercaderia_id
INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
INNER JOIN productos ON productos.id=mercaderias.producto_id
INNER JOIN rangos on productos.rango_id=rangos.id
INNER JOIN locals ON mercaderias.local_id=locals.id
inner JOIN marcas on productos.marca_id=marcas.id
INNER JOIN tipos on productos.tipo_id=tipos.id
WHERE  documentos.fechadocumento>'$fec'
GROUP BY marca_id, tipo_id, rango_id
ORDER BY desmarca, destipo, codrango6";

//dd($sql);
$movimientos = DB::select($sql);

		return View::make('stockafecha.stockafecha')->with('mercaderias', $mercaderias)->with('movimientos', $movimientos)->withInput('fecini');

	}

 

	public function descargar()
	{

		

    	//dd($expresion);

		Excel::create('Stock_ADM_ a_fecha_'.Input::get('fecha'), function($excel) {

		$excel->sheet('Hoja1', function($sheet) {
		$sheet->freezeFirstRow();

		$fec = Input::get('fecha');	
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

		$sql = "SELECT codmarca3, codtipo8, codrango6, marca_id, tipo_id, rango_id,
				" .$expresion. ", 
				COUNT(codmarca3) AS total

				from mercaderias 
				INNER JOIN productos ON mercaderias.producto_id=productos.id
				INNER JOIN rangos on productos.rango_id=rangos.id
				INNER JOIN locals ON mercaderias.local_id=locals.id
				inner JOIN marcas on productos.marca_id=marcas.id
				INNER JOIN tipos on productos.tipo_id=tipos.id

				WHERE mercaderias.estado='ACT' OR mercaderias.estado='INA'
				GROUP BY  marca_id, tipo_id, rango_id
				ORDER BY desmarca, destipo, codrango6, deslocal";


//		dd($sql);							
		$mercaderias = DB::select($sql);

$expresion = '- COUNT(IF (movimientos.tipomovimiento_id=1 and documentos.localfin_id=1 ,movimientos.mercaderia_id,NULL))
+ COUNT(IF (movimientos.tipomovimiento_id=2 and documentos.localini_id=1 ,movimientos.mercaderia_id,NULL)) 
- COUNT(IF (movimientos.tipomovimiento_id=6, movimientos.mercaderia_id,null)) 

+ COUNT(IF (movimientos.tipomovimiento_id=7, movimientos.mercaderia_id,null)) 
AS ALM,';
for ($i = 2; $i <= $cantidad_locales; $i++) 
{
	$expresion .= '
- COUNT(IF (movimientos.tipomovimiento_id=2 and documentos.localfin_id='.$i.', movimientos.mercaderia_id,NULL)) 
- COUNT(IF (movimientos.tipomovimiento_id=4 and documentos.localfin_id='.$i.', movimientos.mercaderia_id,NULL))
+ COUNT(IF (movimientos.tipomovimiento_id=4 and documentos.localini_id='.$i.', movimientos.mercaderia_id,NULL)) 
+ COUNT(IF (movimientos.tipomovimiento_id=3 and documentos.localfin_id='.$i.' and devolucion>=0, movimientos.mercaderia_id,null)) 
- COUNT(IF (movimientos.tipomovimiento_id=3 and documentos.localfin_id='.$i.'  and devolucion<0, movimientos.mercaderia_id,null)) 
+ COUNT(IF (movimientos.tipomovimiento_id=6 and documentos.localini_id='.$i.' , movimientos.mercaderia_id,null)) AS "'. $locals[$i-1].'",';
	//$oracion .= '<td>$value->'.  $locals[$i-1] .'</td>';
}	
$expresion = trim($expresion, ',');
$sql = "SELECT codmarca3, codtipo8, codrango6, marca_id, tipo_id, rango_id,
" .$expresion. "
FROM movimientos 
INNER JOIN mercaderias on mercaderias.id=movimientos.mercaderia_id
INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
INNER JOIN productos ON productos.id=mercaderias.producto_id
INNER JOIN rangos on productos.rango_id=rangos.id
INNER JOIN locals ON mercaderias.local_id=locals.id
inner JOIN marcas on productos.marca_id=marcas.id
INNER JOIN tipos on productos.tipo_id=tipos.id
WHERE  documentos.fechadocumento>'$fec'
GROUP BY marca_id, tipo_id, rango_id
ORDER BY desmarca, destipo, codrango6";

//dd($sql);
$movimientos = DB::select($sql);


		$sheet->loadView('stockafecha.stockafechaxc')->with('mercaderias', $mercaderias)->with('movimientos', $movimientos);

		})->download('xls');  

	});

	}	

}
