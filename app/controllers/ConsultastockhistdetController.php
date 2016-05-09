<?php

class ConsultastockhistdetController extends BaseController {

    public function index()
    {
        //filtro de busqueda
        //dd($request->get('marca_id'));
        $mercaderias = Producto::find(0);
    //    $productos = $this->producto->all(); //cambio para mostrar datos
        return View::make('consultastock.consultastockhistdet', compact('mercaderias'));
    }


    public function consulta()
    {
        $data = Input::all();
        $loc_id = Input::get('local_id');
        $fec = Input::get('fechadocumento');
        //dd($fec);
        $expresion = '';
        $donde = '';
        //$oracion = '';
        $tmptot = 0;
        $tmp1 = Input::get('marca_id');
        $tmp2 = Input::get('tipo_id');
        $tmp3 = Input::get('rango_id');

        $tmptot = $tmp1 + $tmp2 + $tmp3 ;
    if($loc_id==1)
    {
        if($tmptot==0)
        {   
            $sql = "SELECT fechadocumento, 
                    COUNT(if(movimientos.tipomovimiento_id=1,1,NULL)) AS cta_alm_ing, 
                    
                    COUNT(if(movimientos.tipomovimiento_id=6,1,NULL)) AS cta_pto_ing, 
                    COUNT(if(movimientos.tipomovimiento_id=2,2,NULL)) AS cta_pto_sal, 
                    COUNT(if(movimientos.tipomovimiento_id=7,1,NULL)) AS cta_dev_sal

                    from movimientos
                    INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
                    WHERE fechadocumento >= '$fec'
                    GROUP BY fechadocumento
                    ORDER BY fechadocumento DESC";        
    //dd($sql);
            $mercaderias = DB::select($sql);
            //dd($mercaderias);
                return View::make('consultastock.consultastockhistdet')->withInput('local_id', 'fechadocumento', 'marca_id', 'tipo_id', 'rango_id')->with('mercaderias',$mercaderias); 
        }
        else 
        {
            //dd("2da parte"); " .$donde. "

            if(Input::get('marca_id')>0)
                $donde .= ' AND marca_id='.Input::get('marca_id');

            if(Input::get('tipo_id')>0)
                $donde .= ' AND tipo_id='.Input::get('tipo_id');

            if(Input::get('rango_id')>0)
                $donde .= ' AND rango_id='.Input::get('rango_id');

            $sql = "SELECT fechadocumento, 
                    COUNT(if(movimientos.tipomovimiento_id=1,1,NULL)) AS cta_alm_ing, 
                    
                    COUNT(if(movimientos.tipomovimiento_id=6,1,NULL)) AS cta_pto_ing, 
                    COUNT(if(movimientos.tipomovimiento_id=2,2,NULL)) AS cta_pto_sal, 
                    COUNT(if(movimientos.tipomovimiento_id=7,1,NULL)) AS cta_dev_sal

                    from movimientos
                    INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
                    INNER JOIN mercaderias ON movimientos.mercaderia_id=mercaderias.id
                    INNER JOIN productos ON mercaderias.producto_id=productos.id
                    WHERE fechadocumento >= '$fec' " .$donde. "
                    GROUP BY fechadocumento
                    ORDER BY fechadocumento DESC";        
        
            $mercaderias = DB::select($sql);
            //dd($mercaderias);
                return View::make('consultastock.consultastockhistdet')->withInput('local_id', 'fechadocumento')->with('mercaderias',$mercaderias); 
        }                
    }  
    else
    {         
        if($tmptot==0)
        {    
            //dd("ingredsa3");        
            $sql = "SELECT fechadocumento, 
                            COUNT(if(movimientos.tipomovimiento_id=2 AND localfin_id=" .$loc_id. " ,1,NULL)) AS cta_alm_ing, 
                            COUNT(if(movimientos.tipomovimiento_id=3 AND movimientos.devolucion=0 AND localfin_id=" .$loc_id. " ,1,NULL)) AS cta_vta_sal, 
                            COUNT(if(movimientos.tipomovimiento_id=3 AND movimientos.devolucion<0 AND localfin_id=" .$loc_id. " ,1,NULL)) AS cta_cambio,
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
                return View::make('consultastock.consultastockhistdet')->withInput('local_id', 'fechadocumento')->with('mercaderias',$mercaderias);    
        }
        else 
        {
            //dd("4da parte");
            if(Input::get('marca_id')>0)
                $donde .= ' AND marca_id='.Input::get('marca_id');

            if(Input::get('tipo_id')>0)
                $donde .= ' AND tipo_id='.Input::get('tipo_id');

            if(Input::get('rango_id')>0)
                $donde .= ' AND rango_id='.Input::get('rango_id');


            $sql = "SELECT fechadocumento, 
                            COUNT(if(movimientos.tipomovimiento_id=2 AND localfin_id=" .$loc_id. " ,1,NULL)) AS cta_alm_ing, 
                            COUNT(if(movimientos.tipomovimiento_id=3 AND movimientos.devolucion=0 AND localfin_id=" .$loc_id. " ,1,NULL)) AS cta_vta_sal, 
                            COUNT(if(movimientos.tipomovimiento_id=3 AND movimientos.devolucion<0 AND localfin_id=" .$loc_id. " ,1,NULL)) AS cta_cambio, 
                            COUNT(if(movimientos.tipomovimiento_id=4 AND localfin_id=" .$loc_id. " ,1,NULL)) AS cta_pto_ing, 
                            COUNT(if(movimientos.tipomovimiento_id=4 AND localini_id=" .$loc_id. " ,1,NULL)) AS cta_pto_sal, 
                            COUNT(if(movimientos.tipomovimiento_id=6 AND localini_id=" .$loc_id. " ,1,NULL)) AS cta_dev_sal

                    from movimientos
                    INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
                    INNER JOIN mercaderias ON movimientos.mercaderia_id=mercaderias.id
                    INNER JOIN productos ON mercaderias.producto_id=productos.id
                    WHERE fechadocumento >= '$fec' " .$donde. "
                    GROUP BY fechadocumento
                    ORDER BY fechadocumento DESC";        
        
            $mercaderias = DB::select($sql);
            //dd($mercaderias);
                return View::make('consultastock.consultastockhistdet')->withInput('local_id', 'fechadocumento')->with('mercaderias',$mercaderias);             
        }             
    }    
    }    


}    
?>
