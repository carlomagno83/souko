<?php

class ConsultadocsController extends BaseController {

    public function index()
    {
        //filtro de busqueda
        //dd($request->get('marca_id'));
        $documentos = Documento::find(0);
    //    $productos = $this->producto->all(); //cambio para mostrar datos
        return View::make('consultadocs.consultadocs', compact('documentos'));
    }


    public function consulta()
    {
        $data = Input::all();
        $tipomov = Input::get('tipomovimiento_id');
        $fec = Input::get('fechadocumento');
        //dd($fec);
        $expresion = '';
        //$oracion = '';


        if ($tipomov == 1)
        {    
            //dd($sql);        
            $sql = "SELECT documentos.id, numdocfisico, fechadocumento, documentos.localini_id, codprovider3, documentos.localfin_id, 
                COUNT(movimientos.documento_id) AS cantidad, SUM(mercaderias.preciocompra) AS totalcompra,
                SUM(mercaderias.precioventa), desusuario
                from movimientos 
                INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
                INNER JOIN mercaderias ON movimientos.mercaderia_id=mercaderias.id
                INNER JOIN providers ON documentos.localini_id=providers.id
                INNER JOIN users ON documentos.usuario_id=users.id
                WHERE fechadocumento>='$fec'  AND documentos.tipomovimiento_id=" .$tipomov. "
                GROUP BY movimientos.documento_id
                ORDER BY documentos.id";        
    //dd($sql);
            $documentos = DB::select($sql);
            //dd($mercaderias);
                return View::make('consultadocs.consultadocs')->withInput('local_id', 'fechadocumento')->with('documentos',$documentos);    
        }        
        if ($tipomov > 1 AND $tipomov < 7)
        {    
            //dd($sql);        
            $sql = "SELECT documentos.id, numdocfisico, fechadocumento, documentos.localini_id, ini.codlocal3 as localini, 
                documentos.localfin_id, fin.codlocal3 as localfin,
                COUNT(movimientos.documento_id) AS cantidad, SUM(mercaderias.preciocompra) AS totalcompra,
                SUM(mercaderias.precioventa) AS totalventa, desusuario
                from movimientos 
                INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
                INNER JOIN mercaderias ON movimientos.mercaderia_id=mercaderias.id
                INNER JOIN locals ini ON documentos.localini_id=ini.id
                INNER JOIN locals fin ON documentos.localfin_id=fin.id
                INNER JOIN users ON documentos.usuario_id=users.id
                WHERE fechadocumento>='$fec' AND documentos.tipomovimiento_id=" .$tipomov. "
                GROUP BY movimientos.documento_id
                ORDER BY documentos.id";        
    //dd($sql);
            $documentos = DB::select($sql);
            //dd(Input::get('fechadocumento'));
                return View::make('consultadocs.consultadocs')->withInput('local_id', 'fechadocumento')->with('documentos',$documentos);    
        }    
        if ($tipomov == 7)
        {    
            //dd($sql);        
            $sql = "SELECT documentos.id, numdocfisico, fechadocumento, codprovider3, 
                COUNT(movimientos.documento_id) AS cantidad, SUM(mercaderias.preciocompra) AS totalcompra,
                SUM(mercaderias.precioventa), desusuario
                from movimientos 
                INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
                INNER JOIN mercaderias ON movimientos.mercaderia_id=mercaderias.id
                INNER JOIN providers ON documentos.localfin_id=providers.id
                INNER JOIN users ON documentos.usuario_id=users.id
                WHERE fechadocumento>='$fec'  AND documentos.tipomovimiento_id=" .$tipomov. "
                GROUP BY movimientos.documento_id
                ORDER BY documentos.id";        
    //dd($sql);
            $documentos = DB::select($sql);
            //dd($mercaderias);
                return View::make('consultadocs.consultadocs')->withInput('local_id', 'fechadocumento')->with('documentos',$documentos);    
        }              
    }    


    public function detalle1($id)
    {
      
            $sql = "SELECT documentos.id, numdocfisico, fechadocumento, codprovider3, 
                        COUNT(movimientos.documento_id) AS cantidad, SUM(mercaderias.preciocompra) AS totalcompra
                from movimientos 
                INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
                INNER JOIN mercaderias ON movimientos.mercaderia_id=mercaderias.id
                INNER JOIN providers ON providers.id=documentos.localini_id 
                WHERE documentos.id=" .$id. " AND documentos.tipomovimiento_id=1
                GROUP BY movimientos.documento_id
                ORDER BY documentos.id";

        $documentos = DB::select($sql);

        $detalles = DB::table('movimientos')->select('mercaderias.id', 'codproducto31', 'mercaderias.preciocompra', 'productos.precioventa')->join('mercaderias', 'mercaderias.id', '=', 'movimientos.mercaderia_id')->join('productos', 'productos.id', '=', 'mercaderias.producto_id')->where('documento_id','=', $id )->where('tipomovimiento_id','=', 1 )->orderby('mercaderias.id')->get();

        return View::make('consultadocs.consultadocsdetalle1')->with('documentos',$documentos)->with('detalles',$detalles);  

    }

    public function detalle2($id)
    {
      
            $sql = "SELECT documentos.id, numdocfisico, fechadocumento, codlocal3, 
                        COUNT(movimientos.documento_id) AS cantidad, SUM(mercaderias.preciocompra) AS totalcompra
                from movimientos 
                INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
                INNER JOIN mercaderias ON movimientos.mercaderia_id=mercaderias.id
                INNER JOIN locals ON locals.id=documentos.localfin_id 
                WHERE documentos.id=" .$id. " AND documentos.tipomovimiento_id=2
                GROUP BY movimientos.documento_id
                ORDER BY documentos.id";

        $documentos = DB::select($sql);

        $detalles = DB::table('movimientos')->select('mercaderias.id', 'codproducto31', 'mercaderias.preciocompra', 'productos.precioventa')->join('mercaderias', 'mercaderias.id', '=', 'movimientos.mercaderia_id')->join('productos', 'productos.id', '=', 'mercaderias.producto_id')->where('documento_id','=', $id )->where('tipomovimiento_id','=', 2 )->orderby('mercaderias.id')->get();

        return View::make('consultadocs.consultadocsdetalle2')->with('documentos',$documentos)->with('detalles',$detalles);  

    }

    public function detalle3($id)
    {
      
            $sql = "SELECT documentos.id, numdocfisico, fechadocumento, codlocal3, 
                        COUNT(movimientos.documento_id) AS cantidad, SUM(mercaderias.precioventa) AS totalventa, SUM(productos.precioventa) AS totalsugerido
                from movimientos 
                INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
                INNER JOIN mercaderias ON movimientos.mercaderia_id=mercaderias.id
                INNER JOIN productos ON mercaderias.producto_id=productos.id
                INNER JOIN locals ON locals.id=documentos.localfin_id 
                WHERE documentos.id=" .$id. " AND documentos.tipomovimiento_id=3
                GROUP BY movimientos.documento_id
                ORDER BY documentos.id";

        $documentos = DB::select($sql);

        $detalles = DB::table('movimientos')->select('mercaderias.id', 'codproducto31', 'mercaderias.preciocompra', 'mercaderias.precioventa')->join('mercaderias', 'mercaderias.id', '=', 'movimientos.mercaderia_id')->join('productos', 'productos.id', '=', 'mercaderias.producto_id')->where('documento_id','=', $id )->where('tipomovimiento_id','=', 3 )->orderby('mercaderias.id')->get();

        return View::make('consultadocs.consultadocsdetalle3')->with('documentos',$documentos)->with('detalles',$detalles);  

    }

    public function detalle4($id)
    {
      
            $sql = "SELECT documentos.id, numdocfisico, fechadocumento, ini.codlocal3 as localini, fin.codlocal3 as localfin,
                        COUNT(movimientos.documento_id) AS cantidad, SUM(mercaderias.preciocompra) AS totalcompra
                from movimientos 
                INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
                INNER JOIN mercaderias ON movimientos.mercaderia_id=mercaderias.id
                INNER JOIN locals ini ON documentos.localini_id=ini.id
                INNER JOIN locals fin ON documentos.localfin_id=fin.id
                WHERE documentos.id=" .$id. " AND documentos.tipomovimiento_id=4
                GROUP BY movimientos.documento_id
                ORDER BY documentos.id";

        $documentos = DB::select($sql);

        $detalles = DB::table('movimientos')->select('mercaderias.id', 'codproducto31')->join('mercaderias', 'mercaderias.id', '=', 'movimientos.mercaderia_id')->join('productos', 'productos.id', '=', 'mercaderias.producto_id')->where('documento_id','=', $id )->where('tipomovimiento_id','=', 4 )->orderby('mercaderias.id')->get();

        return View::make('consultadocs.consultadocsdetalle4')->with('documentos',$documentos)->with('detalles',$detalles);  

    }

    public function detalle6($id)
    {
      
            $sql = "SELECT documentos.id, numdocfisico, fechadocumento, codlocal3, 
                        COUNT(movimientos.documento_id) AS cantidad, SUM(mercaderias.preciocompra) AS totalcompra
                from movimientos 
                INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
                INNER JOIN mercaderias ON movimientos.mercaderia_id=mercaderias.id
                INNER JOIN locals ON locals.id=documentos.localini_id  
                WHERE documentos.id=" .$id. " AND documentos.tipomovimiento_id=6
                GROUP BY movimientos.documento_id
                ORDER BY documentos.id";

        $documentos = DB::select($sql);

        $detalles = DB::table('movimientos')->select('mercaderias.id', 'codproducto31', 'mercaderias.preciocompra', 'productos.precioventa', 'estado')->join('mercaderias', 'mercaderias.id', '=', 'movimientos.mercaderia_id')->join('productos', 'productos.id', '=', 'mercaderias.producto_id')->where('documento_id','=', $id )->where('tipomovimiento_id','=', 6 )->orderby('mercaderias.id')->get();

        return View::make('consultadocs.consultadocsdetalle6')->with('documentos',$documentos)->with('detalles',$detalles);  

    }

    public function detalle7($id)
    {
      
            $sql = "SELECT documentos.id, numdocfisico, fechadocumento, codprovider3, 
                        COUNT(movimientos.documento_id) AS cantidad, SUM(mercaderias.preciocompra) AS totalcompra
                from movimientos 
                INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
                INNER JOIN mercaderias ON movimientos.mercaderia_id=mercaderias.id
                INNER JOIN providers ON providers.id=documentos.localfin_id 
                WHERE documentos.id=" .$id. " AND documentos.tipomovimiento_id=7
                GROUP BY movimientos.documento_id
                ORDER BY documentos.id";

        $documentos = DB::select($sql);

        $detalles = DB::table('movimientos')->select('mercaderias.id', 'codproducto31', 'mercaderias.preciocompra')->join('mercaderias', 'mercaderias.id', '=', 'movimientos.mercaderia_id')->join('productos', 'productos.id', '=', 'mercaderias.producto_id')->where('documento_id','=', $id )->where('tipomovimiento_id','=', 7 )->orderby('mercaderias.id')->get();

        return View::make('consultadocs.consultadocsdetalle7')->with('documentos',$documentos)->with('detalles',$detalles);  

    }



}    
?>
