<?php

class GeneraguiadevController extends BaseController {

    protected $devuelto;
   	protected $mercaderia;
    public function __construct(Devuelto $devuelto, Mercaderia $mercaderia)
    {
        $this->devuelto = $devuelto;
        $this->mercaderia = $mercaderia;
    }	

    public function index()
	{
        $mercaderias = Mercaderia::find(0);
//usuario logueado        
		$devueltos = DB::table('devueltos')->where('usuario_id','=', Auth::user()->id )->get();
		return View::make('generaguiadev.generaguiadev', compact('mercaderias'))->with('devueltos', $devueltos);
	}

	public function filtrar()
	{
//usuario logueado    
        DB::table('devueltos')->where('usuario_id','=', Auth::user()->id )->delete();
		$data = Input::all();
        $devueltos = DB::table('devueltos')->where('usuario_id','=', Auth::user()->id )->get();//usuario logueado

        if(Input::get('provider_id')>0) 
        {
            $codprovider3 = DB::table('providers')->select('codprovider3')->where('providers.id', '=', Input::get('provider_id'))->pluck('codprovider3');

            $mercaderias = DB::table('mercaderias')->join('locals', 'locals.id', '=', 'mercaderias.local_id')
        										->join('productos', 'productos.id', '=', 'mercaderias.producto_id')
        										->join('providers', 'providers.id', '=', 'productos.provider_id')
        										->select('providers.codprovider3',
        											'mercaderias.id',
        											'productos.codproducto31',
        											'mercaderias.estado',
                                                    'mercaderias.preciocompra',
        											'locals.deslocal')
        										->where('productos.provider_id', '=', Input::get('provider_id'))
        										->where('mercaderias.estado', '=', 'INA')
        										->get();

            return View::make('generaguiadev.generaguiadev', compact('mercaderias'))->withInput('provider_id')->with('devueltos', $devueltos);

        } 
		return View::make('generaguiadev.generaguiadev', compact('mercaderias'))->withInput('provider_id')->with('devueltos', $devueltos);
	}

    public function agregareg()
    {
        $data = Input::all();
        foreach($data as $key=>$value)
        {
            if($key=='checkbox')
            { 
                foreach($value as $key2=>$indice)
                {
//usuario logueado
                    //dd($key2); //el key2 muestra el indice                       
                    DB::table('devueltos')->insert(array('codprovider3' => $data['codprovider3'][$key2],
                                                         'mercaderia_id' => $data['mercaderia_id'][$key2],
                                                         'codproducto31' => $data['codproducto31'][$key2],
                                                         'estado' => $data['estado'][$key2],
                                                         'preciocompra' => $data['preciocompra'][$key2],
                                                         'deslocal' => $data['deslocal'][$key2],
                                                         'usuario_id' =>  Auth::user()->id  ));
                }
            }
        }
//usuario logueado
        $codprovider3 = DB::table('devueltos')->select('codprovider3')->where('usuario_id', '=',  Auth::user()->id )->pluck('codprovider3');
        $provider_id = DB::table('providers')->select('id')->where('codprovider3', '=', $codprovider3)->pluck('id'); 
        $mercaderias = DB::table('mercaderias')->join('locals', 'locals.id', '=', 'mercaderias.local_id')
                                            ->join('productos', 'productos.id', '=', 'mercaderias.producto_id')
                                            ->join('providers', 'providers.id', '=', 'productos.provider_id')
                                            ->select('providers.codprovider3',
                                                'mercaderias.id',
                                                'productos.codproducto31',
                                                'mercaderias.estado',
                                                'mercaderias.preciocompra',
                                                'locals.deslocal')
                                            ->where('productos.provider_id', '=', $provider_id)
                                            ->where('mercaderias.estado', '=', 'INA')
                                            ->whereNotIn('mercaderias.id', function($query)
                                              {
                                                  $query->select('mercaderia_id')
                                                        ->from('devueltos');
                                              })
                                            ->get();
        $devueltos = DB::table('devueltos')->where('usuario_id','=', Auth::user()->id )->get();//usuario logueado
        return View::make('generaguiadev.generaguiadev', compact('mercaderias'))->with('devueltos', $devueltos);

    }

    public function getDelete($mercaderia_id)
    {
        DB::table('devueltos')->where('mercaderia_id', '=', $mercaderia_id)->delete();
        $codprovider3 = DB::table('devueltos')->select('codprovider3')->where('usuario_id', '=',  Auth::user()->id )->pluck('codprovider3');
        $provider_id = DB::table('providers')->select('id')->where('codprovider3', '=', $codprovider3)->pluck('id'); 
        $mercaderias = DB::table('mercaderias')->join('locals', 'locals.id', '=', 'mercaderias.local_id')
                                            ->join('productos', 'productos.id', '=', 'mercaderias.producto_id')
                                            ->join('providers', 'providers.id', '=', 'productos.provider_id')
                                            ->select('providers.codprovider3',
                                                'mercaderias.id',
                                                'productos.codproducto31',
                                                'mercaderias.estado',
                                                'mercaderias.preciocompra',
                                                'locals.deslocal')
                                            ->where('productos.provider_id', '=', $provider_id)
                                            ->where('mercaderias.estado', '=', 'INA')
                                            ->whereNotIn('mercaderias.id', function($query)
                                              {
                                                  $query->select('mercaderia_id')
                                                        ->from('devueltos');
                                              })
                                            ->get();

        $devueltos = DB::table('devueltos')->where('usuario_id','=', Auth::user()->id )->get();//usuario logueado
        return View::make('generaguiadev.generaguiadev', compact('mercaderias'))->with('devueltos', $devueltos);
    }


    public function store()
    {
        //si no hay datos para ingresar
        $devueltos = DB::table('devueltos')->where('usuario_id','=', Auth::user()->id )->get();//usuario logueado
        if(count($devueltos)==0){
            $mercaderias = Mercaderia::find(0);
//usuario logueado        
            $devueltos = DB::table('devueltos')->where('usuario_id','=', Auth::user()->id )->get();
            return View::make('generaguiadev.generaguiadev', compact('mercaderias'))->with('devueltos', $devueltos);
        }

        $data = Input::all();
        foreach($data as $key=>$value)
        {
//usuario logueado
            $codprovider3 = DB::table('devueltos')->select('codprovider3')->where('usuario_id','=', Auth::user()->id )->pluck('codprovider3');  
            $codprovider_id = DB::table('providers')->select('id')->where('codprovider3', '=', $codprovider3)->pluck('id');
            $documento_id = $this->saveDocumento($codprovider_id);
            foreach($value as $key2=>$indice)
            {
                //dd($key2); //el key2 muestra el indice                       
                //DB::table('movimientos')->insert(array('mercaderia_id' => $data['mercaderia_id'][$key2], 'documento_id' => $documento_id, 'flagoferta' => 0));
                //cambio para timestamp
                $movimiento = new Movimiento();
                $movimiento->mercaderia_id = $data['mercaderia_id'][$key];
                $movimiento->documento_id = $documento_id;
                //$movimiento->tipodocumento_id = 7;
                $movimiento->flagoferta = 0;
                $movimiento->save();          
                      
//hay que cambiar por usuario logueado
                DB::table('mercaderias')->where('id', '=', $data['mercaderia_id'][$key2])->update(array('estado' => 'DEV', 'usuario_id' =>1 )); 
            }
            $this->imprimeguia();
        }        

        //$devueltos = DB::table('devueltos')->where('usuario_id','=', Auth::user()->id  )->get();//usuario logueado
		//return View::make('generaguiadev.generaguiadev')->with('devueltos', $devueltos);
        $this->index();
    }

    private function saveDocumento($codprovider_id)
    {

        $documento = new Documento(); //Agrega nuevo documento
        $documento->fechadocumento = date('Y-m-d');
        $documento->tipomovimiento_id = 7; //tipo de movimiento devolucion a proveedor
//usuario logueado
        $documento->usuario_id =  Auth::user()->id ; 
        $documento->flagestado = 'ACT';
        $documento->localini_id = 1;        
        $documento->localfin_id = $codprovider_id; //solo para el tipomov 7 ingresamos id de proveedor
        $documento->save();
        return $documento->id;
        
    }

    public function imprimeguia()
    {

        Excel::create(date('Y-m-d').'DevolucionProveedor', function($excel)
        {
                // Set the title
            $excel->setTitle('Guia de Devolucion al Proveedor');
//Primera hoja
            $excel->sheet('Hoja1', function($sheet)
            {
                $sheet->setPageMargin(array( 0.8, 0.8, 0.8, 0.8 ));
                $sheet->setWidth('A',7);
                $sheet->setWidth('B',10.5);
                $sheet->setWidth('C',42);
                $sheet->setWidth('D',12);
                $sheet->setWidth('E',12);
                $sheet->setWidth('F',12);
                $sheet->setStyle(array( 'font' => array('name' => 'Arial','size' => 11,'bold' => false )));
                $sheet->setColumnFormat(array( 'F' => '0.00' ));
                //Buscamos datos
                $documento_id = DB::table('documentos')->select('id')->orderBy('id', 'desc')->pluck('id');
//usuario logueado
                $codprovider3 = DB::table('devueltos')->select('codprovider3')->where('usuario_id','=', Auth::user()->id )->pluck('codprovider3');  
                $desprovider = DB::table('providers')->where('providers.codprovider3', '=', $codprovider3)->pluck('desprovider');
//usuario logueado
                $usuario_id =  Auth::user()->id ;
                $desusuario = DB::table('users')->select('desusuario')->where('id', '=', $usuario_id)->pluck('desusuario');
    //usuario logueado
                $devueltos = DB::table('devueltos')->where('usuario_id','=', Auth::user()->id )->get(); 
                //dd($mercaderias[0]->id);   $mercaderias[$i]->codproducto31 
                $cont = count($devueltos)-1; //por empezar indice 0
                $sheet->row(1, array('EMBAJADOR SHOES'));
                    $sheet->cell('A1', function($cell) { $cell->setFontSize(26); $cell->setFontWeight('bold'); });

                $sheet->row(3, array('GUIA DE DEVOLUCION A PROVEEDOR'));
                    $sheet->cell('A3', function($cell) { $cell->setFontSize(20); $cell->setFontWeight('bold'); });
                $sheet->row(5, array('Número de documento interno:   '. $documento_id, ''));
                    $sheet->cell('A5', function($cell) { $cell->setFontWeight('bold'); });
                $sheet->row(6, array('Proveedor :   '. $desprovider, '', '', 'Fecha:   '.date('Y-m-d')));
                    $sheet->cell('A6', function($cell) { $cell->setFontWeight('bold'); });                 
                    $sheet->cell('D6', function($cell) { $cell->setFontWeight('bold'); }); 
                $sheet->row(7, array('Usuario :   '. $desusuario, ''));
                    $sheet->cell('A7', function($cell) { $cell->setFontWeight('bold'); });                 

                $sheet->row(9, array('PROV', 'ID', 'DESCRIPCION', 'ESTADO', 'LOCAL', 'P. COMPRA' ));
                    $sheet->cells('A9:F9', function($cells) { $cells->setBackground('#D8D8D8'); });

                $fila = 10;
                $numitems = 0;
                $preciototal = 0;
                for($i=0; $i<=$cont; )
                    {
                        $sheet->row($fila, array($devueltos[$i]->codprovider3, $devueltos[$i]->mercaderia_id, $devueltos[$i]->codproducto31, $devueltos[$i]->estado, $devueltos[$i]->deslocal, $devueltos[$i]->preciocompra ));
                            $sheet->cell('D'.$fila, function($cell) { $cell->setFontColor('#FF0000'); $cell->setFontWeight('bold'); });
                        $preciototal = $preciototal + $devueltos[$i]->preciocompra;
                        $numitems = $numitems +1;
                        $fila=$fila+1;
                        $i=$i+1;
                    }    
                $fila=$fila+2;
                $sheet->row($fila, array($numitems, 'ITEMS EN TOTAL', '', '','TOTAL :', $preciototal ));
                    $sheet->cell('F'. $fila, function($cell) { $cell->setBackground('#D8D8D8'); });

            });
//termina primera hoja

//usuario logueado
            //limpia temporal devueltos
            DB::table('devueltos')->where('usuario_id', '=',  Auth::user()->id )->delete(); 

        })->download('xlsx'); 



    }  


}	
?>
