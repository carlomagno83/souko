<?php

class MovimientocostoController extends BaseController {

	public function index()
	{
		$resultados = Mercaderia::find(0);
		return View::make('movimientocosto.movimientocosto')->with('resultados', $resultados) ;
	}



	public function buscar()
	{
		$anho = Input::get('anho');

		$sql = "SELECT codmarca3, codtipo8, codrango6, 
COUNT(IF (month(d.fechadocumento)=1 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 ,m.mercaderia_id,NULL)) AS ene,
FORMAT(AVG(IF (month(d.fechadocumento)=1 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 , mercaderias.preciocompra,NULL)),2) AS enep,

COUNT(IF (month(d.fechadocumento)=2 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 ,m.mercaderia_id,NULL)) AS feb,
FORMAT(AVG(IF (month(d.fechadocumento)=2 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 , mercaderias.preciocompra,NULL)),2) AS febp,

COUNT(IF (month(d.fechadocumento)=3 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 ,m.mercaderia_id,NULL)) AS mar,
FORMAT(AVG(IF (month(d.fechadocumento)=3 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 , mercaderias.preciocompra,NULL)),2) AS marp,

COUNT(IF (month(d.fechadocumento)=4 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 ,m.mercaderia_id,NULL)) AS abr,
FORMAT(AVG(IF (month(d.fechadocumento)=4 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 , mercaderias.preciocompra,NULL)),2) AS abrp,

COUNT(IF (month(d.fechadocumento)=5 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 ,m.mercaderia_id,NULL)) AS may,
FORMAT(AVG(IF (month(d.fechadocumento)=5 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 , mercaderias.preciocompra,NULL)),2) AS mayp,

COUNT(IF (month(d.fechadocumento)=6 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 ,m.mercaderia_id,NULL)) AS jun,
FORMAT(AVG(IF (month(d.fechadocumento)=6 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 , mercaderias.preciocompra,NULL)),2) AS junp,

COUNT(IF (month(d.fechadocumento)=7 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 ,m.mercaderia_id,NULL)) AS jul,
FORMAT(AVG(IF (month(d.fechadocumento)=7 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 , mercaderias.preciocompra,NULL)),2) AS julp,

COUNT(IF (month(d.fechadocumento)=8 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 ,m.mercaderia_id,NULL)) AS ago,
FORMAT(AVG(IF (month(d.fechadocumento)=8 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 , mercaderias.preciocompra,NULL)),2) AS agop,

COUNT(IF (month(d.fechadocumento)=9 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 ,m.mercaderia_id,NULL)) AS sep,
FORMAT(AVG(IF (month(d.fechadocumento)=9 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 , mercaderias.preciocompra,NULL)),2) AS sepp,

COUNT(IF (month(d.fechadocumento)=10 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 ,m.mercaderia_id,NULL)) AS oct,
FORMAT(AVG(IF (month(d.fechadocumento)=10 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 , mercaderias.preciocompra,NULL)),2) AS octp,

COUNT(IF (month(d.fechadocumento)=11 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 ,m.mercaderia_id,NULL)) AS nov,
FORMAT(AVG(IF (month(d.fechadocumento)=11 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 , mercaderias.preciocompra,NULL)),2) AS novp,

COUNT(IF (month(d.fechadocumento)=12 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 ,m.mercaderia_id,NULL)) AS dic,
FORMAT(AVG(IF (month(d.fechadocumento)=12 AND YEAR(d.fechadocumento)=".$anho." AND m.tipomovimiento_id=1 , mercaderias.preciocompra,NULL)),2) AS dicp

from movimientos m
INNER JOIN documentos d ON m.documento_id=d.id AND m.tipomovimiento_id=d.tipomovimiento_id
INNER JOIN mercaderias ON m.mercaderia_id=mercaderias.id
INNER JOIN productos ON mercaderias.producto_id=productos.id
INNER JOIN marcas on productos.marca_id=marcas.id
INNER JOIN tipos on productos.tipo_id=tipos.id
INNER JOIN rangos on productos.rango_id=rangos.id

GROUP BY codmarca3, codtipo8, codrango6
ORDER BY codmarca3, codtipo8, codrango6";

        $resultados = DB::select($sql);	
//dd($resultados);

        if($resultados)
        {	
			return View::make('movimientocosto.movimientocosto')->with('resultados', $resultados)->withInput('anho') ;
		}
		//en el blade hay un ejemplo de objeto 
		return View::make('movimientocosto.movimientocosto')->with('resultados', $resultados)->withInput('anho')->withErrors(['No hay registros para ese año']) ;


	}

}	
?>
