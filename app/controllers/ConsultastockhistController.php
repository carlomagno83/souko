<?php

class ConsultastockhistController extends BaseController {

	public function index()
	{
		//filtro de busqueda
		//dd($request->get('marca_id'));
		$mercaderias = Producto::find(0);
	//	$productos = $this->producto->all(); //cambio para mostrar datos
		return View::make('consultastock.consultastockhist', compact('mercaderias'));
	}


	public function consulta()
	{
	    $data = Input::all();
	    $loc_id = Input::get('local_id');
	    $fec = Input::get('fechadocumento');
	    //dd($fec);
	    $expresion = '';
	    //$oracion = '';



		//dd($sql);		
		$sql = "SELECT fechadocumento, 
						COUNT(if(movimientos.tipomovimiento_id=2 AND localfin_id=" .$loc_id. " ,1,NULL)) AS cta_alm_ing, 
						COUNT(if(movimientos.tipomovimiento_id=3 AND localfin_id=" .$loc_id. " ,1,NULL)) AS cta_vta_sal, 
						COUNT(if(movimientos.tipomovimiento_id=4 AND localfin_id=" .$loc_id. " ,1,NULL)) AS cta_pto_ing, 
						COUNT(if(movimientos.tipomovimiento_id=4 AND localini_id=" .$loc_id. " ,1,NULL)) AS cta_pto_sal, 
						COUNT(if(movimientos.tipomovimiento_id=6 AND localini_id=" .$loc_id. " ,1,NULL)) AS cta_dev_sal

				from movimientos
				INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
				WHERE fechadocumento >= '$fec'
				GROUP BY fechadocumento
				ORDER BY fechadocumento DESC";		
//dd($sql);
        $mercaderias = DB::select($sql);
        //dd($mercaderias);
			return View::make('consultastock.consultastockhist')->withInput('local_id', 'fechadocumento')->with('mercaderias',$mercaderias);	

	}	


}	
?>
