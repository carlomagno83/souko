<?php

class GananciabrutaController extends BaseController {

	public function index()
	{
		$resultados = Mercaderia::find(0);
		return View::make('gananciabruta.gananciabruta')->with('resultados', $resultados) ;
	}



	public function buscar()
	{
		$anho = Input::get('anho');
/*
		$sql = "SELECT MONTH(documentos.fechadocumento) as mes, local_id, sum(precioventa-preciocompra) as total
					FROM mercaderias m
					left outer JOIN locals l ON m.local_id=l.id
					INNER JOIN  movimientos on m.id=movimientos.mercaderia_id
					INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
					WHERE m.estado='VEN'  AND YEAR(documentos.fechadocumento)=".$anho."
					GROUP BY MONTH(documentos.fechadocumento), m.local_id
					ORDER BY MONTH(documentos.fechadocumento),local_id";
*/
		$sql ="SELECT MONTH(documentos.fechadocumento) as mes, local_id, sum(precioventa-preciocompra) as total
					FROM mercaderias m
					left outer JOIN locals l ON m.local_id=l.id
					INNER JOIN  movimientos on m.id=movimientos.mercaderia_id
					INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
					WHERE documentos.tipomovimiento_id=3  AND YEAR(documentos.fechadocumento)=".$anho."
					GROUP BY MONTH(documentos.fechadocumento), documentos.localfin_id
					ORDER BY mes, local_id";			

        $resultados = DB::select($sql);	
//dd($resultados);
        if($resultados)
        {	
			return View::make('gananciabruta.gananciabruta')->with('resultados', $resultados)->withInput('anho') ;
		}
		//en el blade hay un ejemplo de objeto 
		return View::make('gananciabruta.gananciabruta')->with('resultados', $resultados)->withInput('anho')->withErrors(['No hay registros para ese año']) ;


	}

}	
?>
