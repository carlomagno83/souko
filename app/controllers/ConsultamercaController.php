<?php

class ConsultamercaController extends BaseController {



	public function index()
	{

		return View::make('consultamerca.consultamerca');  
	}


	public function consulta()
	{
		$data = Input::all();
		$cod = $data['nummerca'];
//dd($cod);
        $mercaderias = DB::select("SELECT movimientos.documento_id AS Numdoc, movimientos.tipomovimiento_id, 
                        devolucion, tipomovimientos.destipomovimiento, 
                        if(movimientos.tipomovimiento_id<>7, codlocal3,codprovider3) as codlocal3, 
                        documentos.localini_id as origen, documentos.fechadocumento , documentos.created_at 
                        from movimientos 
                        INNER JOIN tipomovimientos ON tipomovimientos.id = movimientos.tipomovimiento_id 
                        INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id 
                        LEFT OUTER JOIN locals ON locals.id = documentos.localfin_id 
                        LEFT OUTER JOIN providers ON providers.id=documentos.localfin_id
                        WHERE movimientos.mercaderia_id = '$cod' 
                        ORDER BY documentos.created_at");        
        $detalles = DB::select("SELECT mercaderias.id, productos.codproducto31, mercaderias.estado, mercaderias.preciocompra, mercaderias.precioventa
                        from mercaderias
                        INNER JOIN productos ON productos.id = mercaderias.producto_id
                        WHERE mercaderias.id = '$cod'");
//dd($mercaderias);
        return View::make('registroagregar.consultamercaderia')->with('mercaderias', $mercaderias)->with('detalles', $detalles);


	}


 

	

}
