<?php

class ConsultaventaController extends BaseController {

	public function index()
	{
		$resultados = Mercaderia::find(0);
		return View::make('consultaventa.consultaventa')->with('resultados', $resultados) ;
	}



	public function buscar()
	{
		$mes = Input::get('mes');
		$anho = Input::get('anho');

		$sql = "SELECT desusuario, 
			 			COUNT(if(mercaderias.estado='VEN',1,NULL)) AS total_items
						from mercaderias
						INNER JOIN users ON mercaderias.usuario_id=users.id
						INNER JOIN movimientos on mercaderias.id=movimientos.mercaderia_id
						INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id

						WHERE  documentos.tipomovimiento_id=3 AND MONTH(fechadocumento)= ".$mes." AND YEAR(fechadocumento)=".$anho." AND rolusuario='VENDE'

						GROUP BY desusuario";
		//dd($sql);							
        $resultados = DB::select($sql);	
        if($resultados)
        {	
			return View::make('consultaventa.consultaventa')->with('resultados', $resultados)->withInput('mes', 'anho') ;
		}

		return View::make('consultaventa.consultaventa')->with('resultados', $resultados)->withInput('mes', 'anho')->withErrors(['No hay registros para la fecha consultada']) ;
	}

}	
?>
