<?php

class DevolucionptoventaController extends BaseController {

    /**
     * devuelve Repository
     *
     * @var devuelve
     */
    protected $devuelve;
   	protected $mercaderia;
    public function __construct(Devuelve $devuelve, Mercaderia $mercaderia)
    {
        $this->devuelve = $devuelve;
        $this->mercaderia = $mercaderia;
    }


	public function index()
	{
//hay que cambiar por usuario logueado		
		$devuelves = DB::table('devuelves')->where('usuario_id','=', Auth::user()->id )->get();
		return View::make('devolucionptoventa.devolucionptoventa')->with('devuelves', $devuelves);;
	}

	public function agregareg()
	{
		//$data = Input::all();
	    if(Input::get('mercaderia_id')!=null) 
        {
        	//verifica data ingresada
	        $existedata = DB::table('devuelves')->select('codproducto31')->where('mercaderia_id', '=', Input::get('mercaderia_id'))->where('usuario_id','=', Auth::user()->id )->pluck('codproducto31');
			if(is_null($existedata))
	        {	
	        	$encuentra = DB::table('mercaderias')->select('estado')->where('id', '=', Input::get('mercaderia_id'))->pluck('estado');
	            if($encuentra != null)
	            {
	                if ($encuentra=="ACT" OR $encuentra=="INA")
	                {
		                $producto_id = DB::table('mercaderias')->select('producto_id')->where('id', '=', Input::get('mercaderia_id'))->pluck('producto_id');
		                $codproducto31 =  DB::table('productos')->select('codproducto31')->where('id', '=', $producto_id)->pluck('codproducto31');
		         		$deslocal = DB::table('locals')->join('mercaderias', 'locals.id', '=', 'mercaderias.local_id')->select('codlocal3')->where('mercaderias.id','=', Input::get('mercaderia_id'))->pluck('codlocal3');
		         		$estado = DB::table('mercaderias')->select('estado')->where('mercaderias.id','=', Input::get('mercaderia_id'))->pluck('estado');
		                
				        $devuelve = new Devuelve();
				        $devuelve->mercaderia_id = Input::get('mercaderia_id');
				        $devuelve->producto_id = $producto_id;
				        $devuelve->codproducto31 = $codproducto31;
				        $devuelve->deslocal = $deslocal;
				        $devuelve->estado = $estado;
				        $devuelve->nuevoestado = Input::get('estado');
				        //usuario logueado
				        $devuelve->usuario_id =  Auth::user()->id ;
				        $devuelve->save();

			        	$devuelves = DB::table('devuelves')->where('usuario_id','=', Auth::user()->id )->get();

						return View::make('devolucionptoventa.devolucionptoventa')->withInput('usuario_id', 'local_id')->with('devuelves', $devuelves);
					}	
	            }
	        }    
        } 

        $devuelves = DB::table('devuelves')->where('usuario_id','=', Auth::user()->id )->get();//usuario logueado
		return View::make('devolucionptoventa.devolucionptoventa')->withInput('usuario_id', 'local_id')->with('devuelves', $devuelves);
	}

	public function getDelete($mercaderia_id)
	{
		//data = Input::all();
		DB::table('devuelves')->where('mercaderia_id', '=', $mercaderia_id)->delete();

        $devuelves = DB::table('devuelves')->where('usuario_id','=', Auth::user()->id )->get();//usuario logueado
		return View::make('devolucionptoventa.devolucionptoventa')->with('devuelves', $devuelves);
	}

    public function store()
    {
        $devuelves = DB::table('devuelves')->where('usuario_id','=', Auth::user()->id )->get();//usuario logueado
        if(count($devuelves)==0){
            return View::make('devolucionptoventa.devolucionptoventa')->with('devuelves', $devuelves);
        }
        $data = Input::all();
        //dd($data['mercaderia_id'][0]);
        // hay que agregar un control de txn
        //$documento_id = $this->saveDocumento(Input::get('localini')); // cambio por numdocfisico
        $documento_id = $this->saveDocumento(Input::get('localini'), Input::get('numdocfisico'), Input::get('fechadocumento'));
        
        foreach($data['mercaderia_id'] as $key=>$value)
        {
            //echo $data['id'][$key];
            //DB::table('movimientos')->insert(array('mercaderia_id' => $data['mercaderia_id'][$key], 'documento_id' => $documento_id, 'flagoferta' => 0));
            //cambio para timestamp
            $movimiento = new Movimiento();
            $movimiento->mercaderia_id = $data['mercaderia_id'][$key];
            $movimiento->documento_id = $documento_id;
            $movimiento->tipomovimiento_id = 6; // cambio por tipo movimiento
            $movimiento->flagoferta = 0;
            $movimiento->save();

            DB::table('mercaderias')->where('id', '=', $data['mercaderia_id'][$key])->update(array('local_id' => 1, 'estado' => $data['nuevoestado'][$key], 'usuario_id' => $data['usuario_id']));
        }
        
         $this -> imprimedevolucion(Input::get('fechadocumento'));       
//usuario logueado
        DB::table('devuelves')->where('usuario_id', '=',  Auth::user()->id )->delete(); 
//usuario logueado, aunque no llega hasta aqui
	    $devuelves = DB::table('devuelves')->where('usuario_id','=', Auth::user()->id )->get();
		return View::make('devolucionptoventa.devolucionptoventa')->withInput('usuario_id', 'local_id')->with('devuelves', $devuelves);

    }


    private function saveDocumento($local_id, $numdocfisico, $fechadocumento)
    {
        $numdoc = DB::table('documentos')->select('id')->where('tipomovimiento_id', '=', '6')->orderBy('id', 'desc')->pluck('id') + 1; 

        $documento = new Documento(); //Agrega nuevo documento
        $documento->id = $numdoc; //add por tipo movimiento         
        $documento->fechadocumento = $fechadocumento;  //date('Y-m-d');
        $documento->tipomovimiento_id = 6; //tipo de movimiento devolucion de pto vta
        $documento->numdocfisico = $numdocfisico;
//usuario logueado
        $documento->usuario_id =  Auth::user()->id ; 
        $documento->flagestado = 'ACT';
        $documento->localini_id = $local_id;
        $documento->localfin_id = 1;
        $documento->save();
        return $numdoc; // cambio por tipo movimiento
        
    }

     public function imprimedevolucion($fechadocumento)
    {

        Excel::create($fechadocumento.'devoluciondePtoVenta', function($excel)
        {
                // Set the title
            $excel->setTitle('Registro de devoluciones al Almacen');

//segunda hoja para codigo de barra de mercaderia devuelta por cliente
                   
//Primera hoja
            $excel->sheet('Hoja1', function($sheet)
            {
                $sheet->setPageMargin(array( 0.8, 0.8, 0.8, 0.8 ));
                $sheet->setWidth('A',14);
                $sheet->setWidth('B',10.5);
                $sheet->setWidth('C',42);
                $sheet->setWidth('D',12);
                $sheet->setWidth('E',12);
                $sheet->setStyle(array( 'font' => array('name' => 'Arial','size' => 11,'bold' => false )));
                $sheet->setColumnFormat(array( 'E' => '0.00' ));
                //Buscamos datos
                //$documento_id = DB::table('documentos')->select('id')->orderBy('id', 'desc')->pluck('id');  //tipodoc
                $documento_id = DB::table('documentos')->select('id')->where('tipomovimiento_id', '=', '6')->orderBy('id', 'desc')->pluck('id');
                $numdocfisico =  DB::table('documentos')->select('numdocfisico')->where('id', '=', $documento_id)->where('tipomovimiento_id', '=', '6')->pluck('numdocfisico'); //agrega numdocfisico
                $fechadocumento =  DB::table('documentos')->select('fechadocumento')->where('id', '=', $documento_id)->where('tipomovimiento_id', '=', '6')->pluck('fechadocumento'); //agrega numdocfisico

                $localini = DB::table('locals')->join('documentos', 'locals.id', '=', 'documentos.localini_id')
												->select('codlocal3')
												->where('documentos.id', '=', $documento_id)
                                                ->where('tipomovimiento_id', '=', '6')
												->pluck('codlocal3');
                $usuario = DB::table('users')->join('mercaderias', 'users.id', '=', 'mercaderias.usuario_id')
                                            ->join('movimientos', 'mercaderias.id', '=', 'movimientos.mercaderia_id')
                                            ->join('documentos', function($join)
                                                        {
                                                    $join->on('documentos.id', '=',  'movimientos.documento_id');
                                                    $join->on('documentos.tipomovimiento_id','=', 'movimientos.tipomovimiento_id');
                                                        })
                                            ->select('desusuario')
                                            ->where('documentos.id', '=', $documento_id)
                                            ->where('documentos.tipomovimiento_id', '=', '6')
                                            ->pluck('desusuario');
    //usuario logueado
                $devuelves = DB::table('devuelves')->where('usuario_id','=', Auth::user()->id )->get(); 
                //dd($mercaderias[0]->id);   $mercaderias[$i]->codproducto31 
                $cont = Count($devuelves)-1; //por empezar indice 0
                $sheet->row(1, array('EMBAJADOR SHOES'));
                    $sheet->cell('A1', function($cell) { $cell->setFontSize(26); $cell->setFontWeight('bold'); });

                $sheet->row(3, array('GUIA DE DEVOLUCION A ALMACEN'));
                    $sheet->cell('A3', function($cell) { $cell->setFontSize(20); $cell->setFontWeight('bold'); });
                $sheet->row(5, array('Número de documento interno:   '. $documento_id, '', '', 'Doc Físico:   '.$numdocfisico));
                    $sheet->cell('A5', function($cell) { $cell->setFontWeight('bold'); });
                    $sheet->cell('D5', function($cell) { $cell->setFontWeight('bold'); });
                $sheet->row(6, array('Local que Devuelve :   '. $localini, '', '', 'Fecha:   '.$fechadocumento));
                    $sheet->cell('A6', function($cell) { $cell->setFontWeight('bold'); });                 
                    $sheet->cell('D6', function($cell) { $cell->setFontWeight('bold'); }); 
                $sheet->row(7, array('Vendedor :  '. $usuario, ''));
                    $sheet->cell('A7', function($cell) { $cell->setFontWeight('bold'); });                 
                $sheet->row(8, array('Generado por :  '. Auth::user()->desusuario ));
                    $sheet->cell('A8', function($cell) { $cell->setFontWeight('bold'); });                 

                $sheet->row(10, array('MERCADERIA', 'PROD', 'DESCRIPCION', 'ESTADO ANT', 'NUEVO EST'));
                    $sheet->cells('A10:E10', function($cells) { $cells->setBackground('#FA5858'); });

                $fila = 11;
                $numitems = 0;

                for($i=0; $i<=$cont; )
                    {
						$sheet->row($fila, array($devuelves[$i]->mercaderia_id, $devuelves[$i]->producto_id, $devuelves[$i]->codproducto31, $devuelves[$i]->estado, $devuelves[$i]->nuevoestado  ));

                        if ($devuelves[$i]->estado<>'ACT')
                        {
                            $sheet->cell('D'.$fila, function($cell) { $cell->setFontColor('#FF0000'); $cell->setFontWeight('bold'); });
                        }
                        elseif($devuelves[$i]->nuevoestado<>'ACT')
                        {
                            $sheet->cell('E'.$fila, function($cell) { $cell->setFontColor('#FF0000'); $cell->setFontWeight('bold'); });
                        }    
						$numitems =$numitems + 1;
						$fila=$fila+1;
						$i=$i+1;
                    }    
                $fila=$fila+2;
                $sheet->row($fila, array($numitems, 'ITEMS EN TOTAL' ));
                    $sheet->cell('A'. $fila, function($cell) { $cell->setBackground('#FA5858'); });

            });
//termina primera hoja

			//limpia temporal devuelves
//usuario logueado
			DB::table('devuelves')->where('usuario_id', '=',  Auth::user()->id )->delete(); 

        })->download('xlsx'); 
    }  


}	
?>
