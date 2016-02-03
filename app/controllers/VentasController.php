<?php

class VentasController extends BaseController {

    protected $vendido;
   	protected $mercaderia;
    public function __construct(Vendido $vendido, Mercaderia $mercaderia)
    {
        $this->vendido = $vendido;
        $this->mercaderia = $mercaderia;
    }

	public function index()
	{
	        $vendidos = DB::table('vendidos')->where('usuario_id','=', Auth::user()->id )->get();//usuario logueado
			return View::make('ventas.ventas')->with('vendidos', $vendidos);
	}

	public function agregareg()
	{
		$data = Input::all();

        if(Input::get('mercaderia_id')!=null) 
        {
	        $existedata = DB::table('vendidos')->select('codproducto31')->where('mercaderia_id', '=', Input::get('mercaderia_id'))->pluck('codproducto31');
			if(is_null($existedata))
	        {	
	            if(DB::table('mercaderias')->find(Input::get('mercaderia_id')))
	            {

                    $producto_id = DB::table('mercaderias')->select('producto_id')->where('id', '=', Input::get('mercaderia_id'))->pluck('producto_id');
                    $estado = DB::table('mercaderias')->select('estado')->where('id', '=', Input::get('mercaderia_id'))->pluck('estado');
	                $codproducto31 =  DB::table('productos')->select('codproducto31')->where('id', '=', $producto_id)->pluck('codproducto31');
	                $deslocal = DB::table('locals')->join('mercaderias', 'locals.id', '=', 'mercaderias.local_id')->select('deslocal')->where('mercaderias.id','=', Input::get('mercaderia_id'))->pluck('deslocal');
	                $desusuario = DB::table('users')->join('mercaderias', 'users.id', '=', 'mercaderias.usuario_id')->select('desusuario')->where('mercaderias.id','=', Input::get('mercaderia_id'))->pluck('desusuario');

			        $vendido = new Vendido();
			        $vendido->mercaderia_id = Input::get('mercaderia_id');
			        $vendido->producto_id = $producto_id;
			        $vendido->codproducto31 = $codproducto31;
                    $vendido->estado = $estado;
			        $vendido->deslocal = $deslocal;
			        $vendido->precioventa = Input::get('precioventa');			        
			        $vendido->usuario_id = Auth::user()->id; //usuario logueado 
			        $vendido->save();

		        	$vendidos = DB::table('vendidos')->get();

					return View::make('ventas.ventas')->with('vendidos', $vendidos);
	            }
	        }    
        } 

        $vendidos = DB::table('vendidos')->where('usuario_id','=', Auth::user()->id )->get();//usuario logueado
		return View::make('ventas.ventas')->withInput('usuario_id', 'local_id')->with('vendidos', $vendidos);
	}

	public function getDelete($mercaderia_id)
	{
		//data = Input::all();
		DB::table('vendidos')->where('mercaderia_id', '=', $mercaderia_id)->delete();

        $vendidos = DB::table('vendidos')->where('usuario_id','=', Auth::user()->id )->get();//usuario logueado
		return View::make('ventas.ventas')->withInput('usuario_id', 'local_id')->with('vendidos', $vendidos);
	}

    public function store()
    {
        //si no hay datos para ingresar
        $vendidos = DB::table('vendidos')->where('usuario_id','=', Auth::user()->id )->get();//usuario logueado
        if(count($vendidos)==0){
            return View::make('ventas.ventas')->with('vendidos', $vendidos);
        }
        $data = Input::all();
        //dd($data['mercaderia_id'][2]);
        // hay que agregar un control de txn
        $documento_id = $this->saveDocumento(Input::get('local_id'));
        
        foreach($data['mercaderia_id'] as $key=>$value)
        {
            //echo $data['id'][$key];
            DB::table('movimientos')->insert(array('mercaderia_id' => $data['mercaderia_id'][$key], 'documento_id' => $documento_id, 'flagoferta' => 0));
            if ($data['estado'][$key]=='VEN')
                { DB::table('mercaderias')->where('id', '=', $data['mercaderia_id'][$key])->update(array('local_id' => $data['local_id'], 'precioventa' => 0, 'estado' => 'ACT', 'usuario_id' => $data['usuario_id'])); }
            else
                { DB::table('mercaderias')->where('id', '=', $data['mercaderia_id'][$key])->update(array('local_id' => $data['local_id'], 'precioventa' => $data['precioventa'][$key], 'estado' => 'VEN', 'usuario_id' => $data['usuario_id'])); }

        }	    
	    //usuario logueado
        $mercaderias = DB::table('vendidos')->where('usuario_id','=', Auth::user()->id )->get();

        $local = DB::table('locals')->select('deslocal')->where('id', '=', $data['local_id'])->pluck('deslocal');
        $usuario = DB::table('users')->select('desusuario')->where('id', '=', $data['usuario_id'])->pluck('desusuario');
        //$total =  count($mercaderias); NO sirve si hay devolucion

        $this -> imprimeventa();

	    //no va a llegar hasta este punto
        $vendidos = DB::table('vendidos')->where('usuario_id','=', Auth::user()->id )->get();//usuario logueado
		return View::make('ventas.ventas')->with('vendidos', $vendidos);

    }

    private function saveDocumento($local_id)
    {

        $documento = new Documento(); //Agrega nuevo documento
        $documento->fechadocumento = date('Y-m-d');
        $documento->tipomovimiento_id = 3; //tipo de movimiento venta
        $documento->usuario_id =  Auth::user()->id ; // usuario logueado
        $documento->flagestado = 'ACT';
        $documento->localini_id = $local_id;        
        $documento->localfin_id = $local_id;
        $documento->save();
        return $documento->id;
        
    }

    public function imprimepdf($datos)
    {

        //$pdf = PDF::loadView('ventas.ventasreportepdf', $datos);
        //return $pdf->download('ReporteVentas.pdf');
        $pdf = PDF::loadHTML('<h1>Hello World!!</h1>');
        return $pdf->download('ReporteVentas.pdf');
  
    }

      public function imprimeventa()
    {

        Excel::create(date('Y-m-d').'guiaventas', function($excel)
        {
                // Set the title
            $excel->setTitle('Registro de movimiento por local a final de dia');

//segunda hoja para codigo de barra de mercaderia devuelta por cliente
//usuario logueado            
            $devueltos = DB::table('vendidos')->where('usuario_id', '=',  Auth::user()->id )
                                        ->where('estado', '=', 'VEN')
                                        ->get(); 
            $devueltos = count($devueltos);                            
            if($devueltos>0)
            {                              
                $excel->sheet('Hoja2', function($sheet)
                {
                    $sheet->setPageMargin(array( 0.2, 0.2, 0.2, 0.2 ));
                    $sheet->freezeFirstRow();
                    $sheet->setWidth('A',50);
                    $sheet->setWidth('B',50);
                    $sheet->setWidth('C',50);
                    $sheet->setHeight(1,20);

                    $sheet->setStyle(array( 'font' => array('name' => 'Bodoni MT Condensed','size' => 16,'bold' => false )));

                    $mercaderias = new Mercaderia;
                    //obtener datos
                    $documento_id = DB::table('documentos')->select('id')->orderBy('id', 'desc')->pluck('id');  

                    $local = DB::table('locals')->join('mercaderias', 'locals.id', '=', 'mercaderias.local_id')
                                                ->join('movimientos', 'mercaderias.id', '=', 'movimientos.mercaderia_id')
                                                ->join('documentos', 'movimientos.documento_id', '=', 'documentos.id')
                                                ->select('deslocal')
                                                ->where('documentos.id', '=', $documento_id)
                                                ->pluck('deslocal');
                    $usuario = DB::table('users')->join('mercaderias', 'users.id', '=', 'mercaderias.usuario_id')
                                                ->join('movimientos', 'mercaderias.id', '=', 'movimientos.mercaderia_id')
                                                ->join('documentos', 'movimientos.documento_id', '=', 'documentos.id')
                                                ->select('desusuario')
                                                 ->where('documentos.id', '=', $documento_id)
                                                ->pluck('desusuario');                            
                    $mercaderias = DB::table('mercaderias')->join('vendidos','mercaderias.id','=','vendidos.mercaderia_id')
                                        ->join('productos','mercaderias.producto_id','=','productos.id')
                                        ->join('locals','mercaderias.local_id','=','locals.id')
                                        ->select('mercaderias.id',
                                               'mercaderias.producto_id',
                                               'mercaderias.estado',
                                               'mercaderias.preciocompra',
                                               'locals.deslocal',
                                               'productos.codproducto31')
                                        ->where('vendidos.estado','=','VEN')

                                        ->where('vendidos.usuario_id','=',  Auth::user()->id )//usuario logueado
                                        ->get(); 
                   
                    $cont = Count($mercaderias) ;
                    $sheet->row(1, array('MERCADERIAS EN REPOSICION DE LOCAL : '. $local, '', 'USUARIO :'. $usuario));              
                    $fila=2;
                    $cont=$cont - 1;
                        for($i=0; $i<=$cont; )
                        {

                            $sheet->cell('A'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('top'); });
                            $sheet->cell('B'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('top'); });
                            $sheet->cell('C'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('top'); });
                            if($i+1>$cont)
                            {
                                $sheet->row($fila, array($mercaderias[$i]->codproducto31 ));
                                $sheet->setHeight($fila, 85);
                                $fila=$fila+1;
                                $sheet->cell('A'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                                $sheet->cell('B'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                                $sheet->cell('C'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                                $sheet->row($fila, array('*'. $mercaderias[$i]->id .'*' ));
                                break;
                            }    
                            if($i+2>$cont)
                            {
                                $sheet->row($fila, array($mercaderias[$i]->codproducto31, $mercaderias[$i+1]->codproducto31 ));
                                $sheet->setHeight($fila, 85);
                                $fila=$fila+1;
                                $sheet->cell('A'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                                $sheet->cell('B'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                                $sheet->cell('C'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                                $sheet->row($fila, array('*'. $mercaderias[$i]->id .'*', '*'. $mercaderias[$i+1]->id .'*' ));
                                break;
                            }
                  
                            $sheet->row($fila, array($mercaderias[$i]->codproducto31, $mercaderias[$i+1]->codproducto31,$mercaderias[$i+2]->codproducto31 ));
                            $sheet->setHeight($fila, 85);
                            $fila=$fila+1;
                            $sheet->cell('A'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                            $sheet->cell('B'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                            $sheet->cell('C'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                            $sheet->row($fila, array('*'. $mercaderias[$i]->id .'*', '*'. $mercaderias[$i+1]->id .'*', '*'. $mercaderias[$i+2]->id .'*' ));
                            $sheet->setHeight($fila, 85);
                            $i=$i+3;
                            $fila=$fila+1;
                        }
                });
            }    
//termina segunda hoja
            
//Primera hoja
            $excel->sheet('Hoja1', function($sheet)
            {
                $sheet->setPageMargin(array( 0.8, 0.8, 0.8, 0.8 ));
                $sheet->setWidth('A',7);
                $sheet->setWidth('B',10.5);
                $sheet->setWidth('C',42);
                $sheet->setWidth('D',12);
                $sheet->setWidth('E',12);
                $sheet->setStyle(array( 'font' => array('name' => 'Arial','size' => 11,'bold' => false )));
                $sheet->setColumnFormat(array( 'E' => '0.00' ));
                //Buscamos datos
                $documento_id = DB::table('documentos')->select('id')->orderBy('id', 'desc')->pluck('id');  
                $local = DB::table('locals')->join('mercaderias', 'locals.id', '=', 'mercaderias.local_id')
                                            ->join('movimientos', 'mercaderias.id', '=', 'movimientos.mercaderia_id')
                                            ->join('documentos', 'movimientos.documento_id', '=', 'documentos.id')
                                            ->select('deslocal')
                                            ->where('documentos.id', '=', $documento_id)
                                            ->pluck('deslocal');
                $usuario = DB::table('users')->join('mercaderias', 'users.id', '=', 'mercaderias.usuario_id')
                                            ->join('movimientos', 'mercaderias.id', '=', 'movimientos.mercaderia_id')
                                            ->join('documentos', 'movimientos.documento_id', '=', 'documentos.id')
                                            ->select('desusuario')
                                            ->where('documentos.id', '=', $documento_id)
                                            ->pluck('desusuario');
    //usuario logueado
                $vendidos = DB::table('vendidos')->where('usuario_id','=', Auth::user()->id )->get(); 
                //dd($mercaderias[0]->id);   $mercaderias[$i]->codproducto31 
                $cont = Count($vendidos)-1; //por empezar indice 0
                $sheet->row(1, array('EMBAJADOR SHOES'));
                    $sheet->cell('A1', function($cell) { $cell->setFontSize(26); $cell->setFontWeight('bold'); });

                $sheet->row(3, array('GUIA DE VENTAS POR LOCAL'));
                    $sheet->cell('A3', function($cell) { $cell->setFontSize(20); $cell->setFontWeight('bold'); });
                $sheet->row(5, array('Número de documento interno:   '. $documento_id, ''));
                    $sheet->cell('A5', function($cell) { $cell->setFontWeight('bold'); });
                $sheet->row(6, array('Local:   '. $local, '', '', 'Fecha:   '.date('Y-m-d')));
                    $sheet->cell('A6', function($cell) { $cell->setFontWeight('bold'); });                 
                    $sheet->cell('D6', function($cell) { $cell->setFontWeight('bold'); }); 
                $sheet->row(7, array('Vendedor:   '. $usuario, ''));
                    $sheet->cell('A7', function($cell) { $cell->setFontWeight('bold'); });                 
                $sheet->row(8, array('Generado por :   '. Auth::user()->desusuario ));
                    $sheet->cell('A8', function($cell) { $cell->setFontWeight('bold'); });                 

                $sheet->row(10, array('MERCADERIA', 'PRODUCTO', 'DESCRIPCION', 'ESTADO', 'P. VENTA' ));
                    $sheet->cells('A10:E10', function($cells) { $cells->setBackground('#81F781'); });

                $fila = 11;
                $numitems = 0;
                $devueltos = 0;
                $preciototal = 0;
                for($i=0; $i<=$cont; )
                    {
                        if ($vendidos[$i]->estado<>'VEN' )
                        {    
                            $sheet->row($fila, array($vendidos[$i]->mercaderia_id, $vendidos[$i]->producto_id, $vendidos[$i]->codproducto31, $vendidos[$i]->estado, $vendidos[$i]->precioventa ));
                            $numitems =$numitems + 1;
                            $preciototal = $preciototal + $vendidos[$i]->precioventa;
                        }
                        else
                        {
                            $sheet->row($fila, array($vendidos[$i]->mercaderia_id, $vendidos[$i]->producto_id, $vendidos[$i]->codproducto31, $vendidos[$i]->estado, $vendidos[$i]->precioventa*(-1) ));
                                $sheet->cell('E'.$fila, function($cell) { $cell->setFontColor('#FF0000'); $cell->setFontWeight('bold'); });
                            $devueltos =$devueltos + 1;
                            $preciototal = $preciototal - $vendidos[$i]->precioventa;
                        }    
                        $fila=$fila+1;
                        $i=$i+1;
                    }    
                $fila=$fila+2;
                $sheet->row($fila, array($numitems, 'ITEMS EN TOTAL', '', 'VENTA :', $preciototal ));
                    $sheet->cell('E'. $fila, function($cell) { $cell->setBackground('#81F781'); });
                $sheet->row($fila+1, array($devueltos, 'DEVUELTOS' ));

            });
//termina primera hoja

//modif para usuario logueado
            //limpia temporal vendidos
            DB::table('vendidos')->where('usuario_id', '=',  Auth::user()->id )->delete(); 
            $this->index();

        })->download('xlsx'); 



    }  

}	
?>
