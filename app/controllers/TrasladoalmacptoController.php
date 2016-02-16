<?php

class TrasladoalmacptoController extends BaseController {

    /**
     * Tempo Repository
     *
     * @var Tempo
     */
    protected $tempo;
   	protected $mercaderia;
    public function __construct(Tempo $tempo, Mercaderia $mercaderia)
    {
        $this->tempo = $tempo;
        $this->mercaderia = $mercaderia;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 public function index()
	{
//usuario logueado
	        //$tempos = DB::table('tempos')->where('usuario_id','=',Auth::user()->id)->get();
	        $tempos = DB::table('tempos')->where('usuario_id','=',Auth::user()->id )->get();
			return View::make('trasladoalmacpto.trasladoalmacpto')->with('tempos', $tempos);

	}

	public function agregareg()
	{
		//$data = Input::all();
	    if(Input::get('mercaderia_id')!=null) 
        {
        	//verifica data ingresada
	        $existedata = DB::table('tempos')->select('codproducto31')->where('mercaderia_id', '=', Input::get('mercaderia_id'))->pluck('codproducto31');
			if(is_null($existedata))
	        {	
	        	$encuentra = DB::table('mercaderias')->select('estado')->where('id', '=', Input::get('mercaderia_id'))->pluck('estado');
	            if($encuentra != null)
	            {
	                if ($encuentra=="ACT" OR $encuentra=="INA")
	                {
		                $producto_id = DB::table('mercaderias')->select('producto_id')->where('id', '=', Input::get('mercaderia_id'))->pluck('producto_id');
		                $codproducto31 =  DB::table('productos')->select('codproducto31')->where('id', '=', $producto_id)->pluck('codproducto31');
		         		$deslocal = DB::table('locals')->join('mercaderias', 'locals.id', '=', 'mercaderias.local_id')->select('deslocal')->where('mercaderias.id','=', Input::get('mercaderia_id'))->pluck('deslocal');
		         		$estado = DB::table('mercaderias')->select('estado')->where('mercaderias.id','=', Input::get('mercaderia_id'))->pluck('estado');
		                
				        $tempo = new Tempo();
				        $tempo->mercaderia_id = Input::get('mercaderia_id');
				        $tempo->producto_id = $producto_id;
				        $tempo->codproducto31 = $codproducto31;
				        $tempo->deslocal = $deslocal;
				        $tempo->estado = $estado;
				        $tempo->usuario_id = Auth::user()->id; //usuario logueado 
				        $tempo->save();

			        	$tempos = DB::table('tempos')->get();

						return View::make('trasladoalmacpto.trasladoalmacpto')->withInput('usuario_id', 'local_id')->with('tempos', $tempos);
					}	
	            }
	        }    
        } 

        $tempos = DB::table('tempos')->where('usuario_id','=',Auth::user()->id)->get();
        //usuario logueado
		return View::make('trasladoalmacpto.trasladoalmacpto')->withInput('usuario_id', 'local_id')->with('tempos', $tempos);
	}

	public function getDelete($mercaderia_id)
	{
		//data = Input::all();
		DB::table('tempos')->where('mercaderia_id', '=', $mercaderia_id)->delete();

        $tempos = DB::table('tempos')->where('usuario_id','=',Auth::user()->id )->get();//usuario logueado
		return View::make('trasladoalmacpto.trasladoalmacpto')->withInput('usuario_id', 'local_id')->with('tempos', $tempos);
	}

    public function store()
    {
        
        $tempos = DB::table('tempos')->where('usuario_id','=',Auth::user()->id )->get();//usuario logueado
        if(count($tempos)==0){
            return View::make('trasladoalmacpto.trasladoalmacpto')->with('tempos', $tempos);
        }

        $data = Input::all();
        //dd($data['mercaderia_id'][2]);
        // hay que agregar un control de txn
        $documento_id = $this->saveDocumento(Input::get('local_id'), Input::get('numdocfisico'));
        
        foreach($data['mercaderia_id'] as $key=>$value)
        {
            //echo $data['id'][$key];
            //DB::table('movimientos')->insert(array('mercaderia_id' => $data['mercaderia_id'][$key], 'documento_id' => $documento_id, 'flagoferta' => 0));
            //cambio para agregar timestamp
            $movimiento = new Movimiento();
            $movimiento->mercaderia_id =  $data['mercaderia_id'][$key];
            $movimiento->tipomovimiento_id = 2; // cambio por tipo movimiento
            $movimiento->documento_id = $documento_id;
            $movimiento->flagoferta = 0;
            $movimiento->save();
            DB::table('mercaderias')->where('id', '=', $data['mercaderia_id'][$key])->update(array('local_id' => $data['local_id'], 'usuario_id' => $data['usuario_id']));
        }

        $this->imprimesalida();

        //Ya no realiza por la func de impresion
	   	$tempos = DB::table('tempos')->where('usuario_id','=', Auth::user()->id )->get();//usuario logueado
		return View::make('trasladoalmacpto.trasladoalmacpto')->withInput('usuario_id', 'local_id')->with('tempos', $tempos);

    }

    private function saveDocumento($local_id, $numdocfisico)
    {
        $numdoc = DB::table('documentos')->select('id')->where('tipomovimiento_id', '=', '2')->orderBy('id', 'desc')->pluck('id') + 1; 

        $documento = new Documento(); //Agrega nuevo documento
        $documento->id = $numdoc; //add por tipo movimiento 
        $documento->fechadocumento = date('Y-m-d');
        $documento->tipomovimiento_id = 2; //tipo de movimiento salida a pto de vta
        $documento->usuario_id = Auth::user()->id; // usuario logueado
        $documento->numdocfisico = $numdocfisico;
        $documento->flagestado = 'ACT';
        $documento->localini_id = 1; //almacen
        $documento->localfin_id = $local_id;
        $documento->save();
        return $numdoc; // cambio por tipo movimiento
        
    }

      public function imprimesalida()
    {

        Excel::create(date('Y-m-d').'guiaSalida', function($excel)
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
                $documento_id = DB::table('documentos')->select('id')->where('tipomovimiento_id', '=', '2')->orderBy('id', 'desc')->pluck('id'); //buscar tipo 
                $numdocfisico =  DB::table('documentos')->select('numdocfisico')->where('id', '=', $documento_id)->where('tipomovimiento_id', '=', '2')->pluck('numdocfisico'); //agrega numdocfisico

                $local = DB::table('locals')->join('mercaderias', 'locals.id', '=', 'mercaderias.local_id')
                                            ->join('movimientos', 'mercaderias.id', '=', 'movimientos.mercaderia_id')
                                            ->join('documentos', function($join)
                                                        {
                                                    $join->on('documentos.id', '=',  'movimientos.documento_id');
                                                    $join->on('documentos.tipomovimiento_id','=', 'movimientos.tipomovimiento_id');
                                                        })
                                            ->select('deslocal')
                                            ->where('documentos.id', '=', $documento_id)
                                            ->where('documentos.tipomovimiento_id', '=', '2')
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
                                            ->where('documentos.tipomovimiento_id', '=', '2')
                                            ->pluck('desusuario');
    //usuario logueado
                $tempos = DB::table('tempos')->where('usuario_id','=',Auth::user()->id )->get(); 
                //dd($mercaderias[0]->id);   $mercaderias[$i]->codproducto31 
                $cont = Count($tempos)-1; //por empezar indice 0
                $sheet->row(1, array('EMBAJADOR SHOES'));
                    $sheet->cell('A1', function($cell) { $cell->setFontSize(26); $cell->setFontWeight('bold'); });

                $sheet->row(3, array('GUIA DE SALIDAS DE ALMACEN'));
                    $sheet->cell('A3', function($cell) { $cell->setFontSize(20); $cell->setFontWeight('bold'); });
                $sheet->row(5, array('Número de documento interno:   '. $documento_id. '                         Doc Físico:   '.$numdocfisico));
                    $sheet->cell('A5', function($cell) { $cell->setFontWeight('bold'); });
                $sheet->row(6, array('Local:   '. $local. '                         Fecha:   '.date('Y-m-d')));
                    $sheet->cell('A6', function($cell) { $cell->setFontWeight('bold'); });                 
                    $sheet->cell('D6', function($cell) { $cell->setFontWeight('bold'); }); 
                $sheet->row(7, array('Vendedor:   '. $usuario, ''));
                    $sheet->cell('A7', function($cell) { $cell->setFontWeight('bold'); });                 
                $sheet->row(8, array('Generado por :   '. Auth::user()->desusuario ));
                    $sheet->cell('A8', function($cell) { $cell->setFontWeight('bold'); });                 

                $sheet->row(10, array('MERCADERIA', 'PROD', 'DESCRIPCION', 'ESTADO'));
                    $sheet->cells('A10:D10', function($cells) { $cells->setBackground('#81F7F3'); });

                $fila = 11;
                $numitems = 0;


                for($i=0; $i<=$cont; )
                    {
                        if ($tempos[$i]->estado<>'VEN' )
                        {    
                            $sheet->row($fila, array($tempos[$i]->mercaderia_id, $tempos[$i]->producto_id, $tempos[$i]->codproducto31, $tempos[$i]->estado ));
                        }
                        else
                        {
                            $sheet->row($fila, array($tempos[$i]->mercaderia_id, $tempos[$i]->producto_id, $tempos[$i]->codproducto31, $tempos[$i]->estado ));
                                $sheet->cell('D'.$fila, function($cell) { $cell->setFontColor('#FF0000'); $cell->setFontWeight('bold'); });
                        }    
						$numitems =$numitems + 1;
						$fila=$fila+1;
						$i=$i+1;
                    }    
                $fila=$fila+2;
                $sheet->row($fila, array($numitems, 'ITEMS EN TOTAL' ));
                    $sheet->cell('A'. $fila, function($cell) { $cell->setBackground('#81F7F3'); });

            });
//termina primera hoja

//modif para usuario logueado
            //limpia temporal tempos
        	DB::table('tempos')->where('usuario_id', '=', Auth::user()->id )->delete(); 

        })->download('xlsx'); 



    }  

}	
?>
