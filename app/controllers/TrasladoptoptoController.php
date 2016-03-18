<?php

class TrasladoptoptoController extends BaseController {
 
    protected $traslado;
   	protected $mercaderia;
    public function __construct(Traslado $traslado, Mercaderia $mercaderia)
    {
        $this->traslado = $traslado;
        $this->mercaderia = $mercaderia;
    }

	public function index()
	{

	        //usuario logueado
            $traslados = DB::table('traslados')->where('usuario_id','=', Auth::user()->id )->get();
	        
			return View::make('trasladoptopto.trasladoptopto')->with('traslados', $traslados);
	}

	public function agregareg()
	{
		$data = Input::all();
        if(Input::get('mercaderia_id')!=null) 
        {
	        $existedata = DB::table('traslados')->select('codproducto31')->where('mercaderia_id', '=', Input::get('mercaderia_id'))->where('usuario_id','=', Auth::user()->id )->pluck('codproducto31');
			if(is_null($existedata))
	        {	
	            if(DB::table('mercaderias')->find(Input::get('mercaderia_id')))
	            {

	                $producto_id = DB::table('mercaderias')->select('producto_id')->where('id', '=', Input::get('mercaderia_id'))->pluck('producto_id');
	                $estado = DB::table('mercaderias')->select('estado')->where('id', '=', Input::get('mercaderia_id'))->pluck('estado');
	                $codproducto31 =  DB::table('productos')->select('codproducto31')->where('id', '=', $producto_id)->pluck('codproducto31');
	                $deslocal = DB::table('locals')->join('mercaderias', 'locals.id', '=', 'mercaderias.local_id')->select('deslocal')->where('mercaderias.id','=', Input::get('mercaderia_id'))->pluck('deslocal');
	                $desusuario = DB::table('users')->join('mercaderias', 'users.id', '=', 'mercaderias.usuario_id')->select('desusuario')->where('mercaderias.id','=', Input::get('mercaderia_id'))->pluck('desusuario');

			        $traslado = new Traslado();
			        $traslado->mercaderia_id = Input::get('mercaderia_id');
			        $traslado->producto_id = $producto_id;
			        $traslado->codproducto31 = $codproducto31;
			        $traslado->deslocal = $deslocal;
			        $traslado->desusuario = $desusuario;
			        $traslado->estado =$estado;			        
			        $traslado->usuario_id = Auth::user()->id; //usuario logueado
			        $traslado->save();

		        	$traslados = DB::table('traslados')->where('usuario_id','=', Auth::user()->id )->get();

					return View::make('trasladoptopto.trasladoptopto')->with('traslados', $traslados);
	            }
	        }    
        } 
 
        $traslados = DB::table('traslados')->where('usuario_id','=', Auth::user()->id )->get();
        //usuario logueado
		return View::make('trasladoptopto.trasladoptopto')->withInput('usuario_id', 'local_id')->with('traslados', $traslados);
	}

	public function getDelete($mercaderia_id)
	{
		//data = Input::all();
		DB::table('traslados')->where('mercaderia_id', '=', $mercaderia_id)->delete();

        $traslados = DB::table('traslados')->where('usuario_id','=', Auth::user()->id )->get();//usuario logueado
		return View::make('trasladoptopto.trasladoptopto')->withInput('usuario_id', 'local_id')->with('traslados', $traslados);
	}

    public function store()
    {
        $traslados = DB::table('traslados')->where('usuario_id','=', Auth::user()->id )->get();//usuario logueado
        if(count($traslados)==0){
            return View::make('trasladoptopto.trasladoptopto')->with('traslados', $traslados);
        }
		$data = Input::all();
        //dd($data['mercaderia_id'][2]);
        // hay que agregar un control de txn
        //$documento_id = $this->saveDocumento(Input::get('localini'), Input::get('localfin'));  //cambio para doc fisico
        $documento_id = $this->saveDocumento(Input::get('localini'), Input::get('localfin'), Input::get('numdocfisico'), Input::get('fechadocumento'));
        
        foreach($data['mercaderia_id'] as $key=>$value)
        {
            //echo $data['id'][$key];
            //DB::table('movimientos')->insert(array('mercaderia_id' => $data['mercaderia_id'][$key], 'documento_id' => $documento_id, 'flagoferta' => 0));
            //se cambia para grabar el timestamp
            $movimiento = new Movimiento();
            $movimiento->mercaderia_id = $data['mercaderia_id'][$key];
            $movimiento->documento_id = $documento_id;
            $movimiento->tipomovimiento_id = 4; // cambio por tipo movimiento
            $movimiento->flagoferta = 0;
            $movimiento->save();

            DB::table('mercaderias')->where('id', '=', $data['mercaderia_id'][$key])->update(array('local_id' => $data['localfin'], 'usuario_id' => $data['usuario_id']));
        }
		$this->imprime(Input::get('fechadocumento'));

	    $traslados = DB::table('traslados')->where('usuario_id','=', Auth::user()->id )->get();//usuario logueado
		return View::make('trasladoptopto.trasladoptopto')->withInput('usuario_id', 'local_id')->with('traslados', $traslados);

    }

    //private function saveDocumento($localini, $localfin)  //cambio para doc fisico
    private function saveDocumento($localini, $localfin, $numdocfisico, $fechadocumento)
    {
        $numdoc = DB::table('documentos')->select('id')->where('tipomovimiento_id', '=', '4')->orderBy('id', 'desc')->pluck('id') + 1; 

        $documento = new Documento(); //Agrega nuevo documento
        $documento->id = $numdoc; //add por tipo movimiento         
        $documento->fechadocumento = $fechadocumento;   //date('Y-m-d');
        $documento->tipomovimiento_id = 4; //tipo de movimiento pto a pto
        $documento->numdocfisico = $numdocfisico;
        $documento->usuario_id =  Auth::user()->id ; // usuario logueado
        $documento->flagestado = 'ACT';
        $documento->localini_id = $localini;
        $documento->localfin_id = $localfin;
        $documento->save();
        return $numdoc; // cambio por tipo movimiento
        
    }

     public function imprime($fechadocumento)
    {

        Excel::create($fechadocumento.'guiaTraslado', function($excel)
        {
                // Set the title
            $excel->setTitle('Registro de traslados hacia local');

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
                $documento_id = DB::table('documentos')->select('id')->where('tipomovimiento_id', '=', '4')->orderBy('id', 'desc')->pluck('id');  //busca por tipomov
                $numdocfisico = DB::table('documentos')->select('numdocfisico')->where('tipomovimiento_id', '=', '4')->orderBy('id', 'desc')->pluck('numdocfisico');  //numdocfisico
                $fechadocumento = DB::table('documentos')->select('fechadocumento')->where('tipomovimiento_id', '=', '4')->orderBy('id', 'desc')->pluck('fechadocumento');  //numdocfisico

                $localini = DB::table('locals')->join('documentos', 'locals.id', '=', 'documentos.localini_id')
												->select('deslocal')
												->where('documentos.id', '=', $documento_id)
                                                ->where('documentos.tipomovimiento_id', '=', '4')
												->pluck('deslocal');
				$localfin = DB::table('locals')->join('documentos', 'locals.id', '=', 'documentos.localfin_id')
												->select('deslocal')
												->where('documentos.id', '=', $documento_id)
                                                ->where('documentos.tipomovimiento_id', '=', '4')
												->pluck('deslocal');
                $usuario = DB::table('users')->join('mercaderias', 'users.id', '=', 'mercaderias.usuario_id')
                                            ->join('movimientos', 'mercaderias.id', '=', 'movimientos.mercaderia_id')
                                            ->join('documentos', function($join)
                                                        {
                                                    $join->on('documentos.id', '=',  'movimientos.documento_id');
                                                    $join->on('documentos.tipomovimiento_id','=', 'movimientos.tipomovimiento_id');
                                                        })
                                            ->select('desusuario')
                                            ->where('documentos.id', '=', $documento_id)
                                            ->where('documentos.tipomovimiento_id', '=', '4')
                                            ->pluck('desusuario');
    //usuario logueado
                $traslados = DB::table('traslados')->where('usuario_id','=', Auth::user()->id )->get(); 
                //dd($mercaderias[0]->id);   $mercaderias[$i]->codproducto31 
                $cont = Count($traslados)-1; //por empezar indice 0
                $sheet->row(1, array('EMBAJADOR SHOES'));
                    $sheet->cell('A1', function($cell) { $cell->setFontSize(26); $cell->setFontWeight('bold'); });

                $sheet->row(3, array('GUIA DE TRASLADO DE PTO A PTO'));
                    $sheet->cell('A3', function($cell) { $cell->setFontSize(20); $cell->setFontWeight('bold'); });
                $sheet->row(5, array('Número de documento interno:   '. $documento_id, ''));
                    $sheet->cell('A5', function($cell) { $cell->setFontWeight('bold'); });
                $sheet->row(6, array('Local Inicial:   '. $localini. '                 Fecha:   '.$fechadocumento));
                    $sheet->cell('A6', function($cell) { $cell->setFontWeight('bold'); });                 
                    $sheet->cell('D6', function($cell) { $cell->setFontWeight('bold'); }); 
                $sheet->row(7, array('Local Solicitante:  '. $localfin .'         Solicitante:  '. $usuario, ''));
                    $sheet->cell('A7', function($cell) { $cell->setFontWeight('bold'); });                 
                //$sheet->row(8, array('Generado por :  '. Auth::user()->desusuario ));  //numdocfisico
                $sheet->row(8, array('Generado por :  '. Auth::user()->desusuario . '      Num Doc Físico:   '. $numdocfisico));     
                    $sheet->cell('A8', function($cell) { $cell->setFontWeight('bold'); });                 

                $sheet->row(10, array('MERCADERIA', 'PROD', 'DESCRIPCION', 'ESTADO'));
                    $sheet->cells('A10:D10', function($cells) { $cells->setBackground('#F5A9F2'); });

                $fila = 11;
                $numitems = 0;

                for($i=0; $i<=$cont; )
                    {
                        if ($traslados[$i]->estado=='ACT' )
                        {    
                            $sheet->row($fila, array($traslados[$i]->mercaderia_id, $traslados[$i]->producto_id, $traslados[$i]->codproducto31, $traslados[$i]->estado ));
                        }
                        else
                        {
                            $sheet->row($fila, array($traslados[$i]->mercaderia_id, $traslados[$i]->producto_id, $traslados[$i]->codproducto31, $traslados[$i]->estado ));
                                $sheet->cell('D'.$fila, function($cell) { $cell->setFontColor('#FF0000'); $cell->setFontWeight('bold'); });
                        }    
						$numitems =$numitems + 1;
						$fila=$fila+1;
						$i=$i+1;
                    }    
                $fila=$fila+2;
                $sheet->row($fila, array($numitems, 'ITEMS EN TOTAL' ));
                    $sheet->cell('A'. $fila, function($cell) { $cell->setBackground('#F5A9F2'); });

            });
//termina primera hoja

			//limpia trasladoral traslados
//usuario logueado
			DB::table('traslados')->where('usuario_id', '=',  Auth::user()->id )->delete(); 


        })->download('xlsx'); 



    }  
}	
?>
