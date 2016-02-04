<?php


class IngresoproveedorController extends BaseController
{
    /**
     * Producto Repository
     *
     * @var Producto
     */
    protected $producto;

    public function __construct(Producto $producto)
    {
        $this->producto = $producto;
    }

    public function index()
    {

        //$movimientos = Movimiento::all();
        //return View::make('ingresoproveedor.index')->with('movimientos',$movimientos);
        $productos = Producto::find(0);
        //$entradas = DB::table('entradas')->where('usuario_id','=',1)->get();//hay que cambiar por usuario logueado
        //usuario logueado
        $entradas = DB::table('entradas')->where('usuario_id','=', Auth::user()->id)->get();//hay que cambiar por usuario logueado

        return View::make('ingresoproveedor.create', compact('productos'))->with('entradas', $entradas);

    }

    public function filtrar()
    { 
        //$entradas = DB::table('entradas')->where('usuario_id','=',1)->get();//hay que cambiar por usuario logueado
        //usuario logueado
        $entradas = DB::table('entradas')->where('usuario_id','=', Auth::user()->id)->get();//hay que cambiar por usuario logueado

        //Si no hay filtro
        $tmptot = 0;
        $tmp1 = Input::get('provider_id');
        $tmp2 = Input::get('marca_id');
        $tmp3 = Input::get('tipo_id');
        $tmp4 = Input::get('modelo_id');
        $tmp5 = Input::get('color_id');
        $tmp6 = Input::get('material_id');
        $tmp7 = Input::get('rango_id');
        $tmptot = $tmp1 + $tmp2 + $tmp3 + $tmp4 + $tmp5 + $tmp6 + $tmp7 ;
        
        if( $tmptot == 0 ){

                $productos = Producto::where('provider_id','>',0);
                $productos = $productos->join('providers','productos.provider_id','=','providers.id')
                                    ->join('marcas','productos.marca_id','=','marcas.id')
                                    ->join('tipos','productos.tipo_id','=','tipos.id')
                                    ->join('modelos','productos.modelo_id','=','modelos.id')
                                    ->join('materials','productos.material_id','=','materials.id')
                                    ->join('colors','productos.color_id','=','colors.id')
                                    ->join('rangos','productos.rango_id','=','rangos.id')
                              ->select('productos.id',
                                       'productos.provider_id',
                                       'providers.codprovider3',
                                       'productos.marca_id',
                                       'marcas.codmarca3',
                                       'productos.tipo_id',
                                       'tipos.codtipo8',                                       
                                       'productos.modelo_id',
                                       'modelos.codmodelo6',
                                       'productos.material_id',
                                       'materials.codmaterial3',
                                       'productos.color_id',
                                       'colors.codcolor6',
                                       'productos.rango_id',
                                       'rangos.codrango3',
                                       'productos.talla_id',
                                       'productos.codproducto31',
                                       'productos.preciocompra',
                                       'productos.precioventa')
                                ->orderBy('productos.codproducto31')
                                ->get();
            return View::make('ingresoproveedor.create')->with('productos',$productos)->with('entradas', $entradas); 


        }

        //Si hay filtros
        $productos = Producto::where('provider_id','>',0);
        if(Input::get('provider_id')>0)
            $productos = $productos->where('provider_id',Input::get('provider_id'));

        if(Input::get('marca_id')>0)
            $productos = $productos->where('marca_id',Input::get('marca_id'));

        if(Input::get('tipo_id')>0)
            $productos = $productos->where('tipo_id',Input::get('tipo_id'));

        if(Input::get('modelo_id')>0)
            $productos = $productos->where('modelo_id',Input::get('modelo_id'));

        if(Input::get('color_id')>0)
            $productos = $productos->where('color_id',Input::get('color_id'));

        if(Input::get('material_id')>0)
            $productos = $productos->where('material_id',Input::get('material_id'));

        if(Input::get('rango_id')>0)
            $productos = $productos->where('rango_id',Input::get('rango_id'));


        $productos = $productos->join('providers','productos.provider_id','=','providers.id')
                                    ->join('marcas','productos.marca_id','=','marcas.id')
                                    ->join('tipos','productos.tipo_id','=','tipos.id')
                                    ->join('modelos','productos.modelo_id','=','modelos.id')
                                    ->join('materials','productos.material_id','=','materials.id')
                                    ->join('colors','productos.color_id','=','colors.id')
                                    ->join('rangos','productos.rango_id','=','rangos.id')
                              ->select('productos.id',
                                       'productos.provider_id',
                                       'providers.codprovider3',
                                       'productos.marca_id',
                                       'marcas.codmarca3',
                                       'productos.tipo_id',
                                       'tipos.codtipo8',                                       
                                       'productos.modelo_id',
                                       'modelos.codmodelo6',
                                       'productos.material_id',
                                       'materials.codmaterial3',
                                       'productos.color_id',
                                       'colors.codcolor6',
                                       'productos.rango_id',
                                       'rangos.codrango3',
                                       'productos.talla_id',
                                       'productos.codproducto31',
                                       'productos.preciocompra',
                                       'productos.precioventa')
                                /*->whereNotIn('productos.id', function($query)
                                              {
                                                  $query->select('producto_id')
                                                        ->from('entradas');
                                              })*/
                                ->get();
//hay que cambiar por usuario logueado
        //$entradas = DB::table('entradas')->where('usuario_id','=',1)->get();
        //usuario logueado
        $entradas = DB::table('entradas')->where('usuario_id','=', Auth::user()->id)->get();

        return View::make('ingresoproveedor.create')->withInput('provider_id', 'marca_id', 'tipo_id', 'modelo_id', 'material_id', 'color_id' , 'rango_id')->with('productos',$productos)->with('entradas', $entradas);       

    }   

    public function agregar() //agrega los registros a una segunda grilla y la tabla temporal
    {
        $data = Input::all();

        foreach($data as $key=>$value)
        {
            if($key=='cantidad')            
            {
              foreach($value as $key2=>$cantidad)
              {
                if($cantidad>0 AND $data['preciocompra'][$key2]>0)
                {
//usuario logueado
                  DB::table('entradas')->insert(array('producto_id' => $data['producto_id'][$key2], 
                                                      'codproducto31' => $data['codproducto31'][$key2],
                                                      'cantidad' => $data['cantidad'][$key2], 
                                                      'preciocompra' => $data['preciocompra'][$key2], 
                                                      'ultimoprecio' => $data['ultimoprecio'][$key2],
                                                      'usuario_id' => Auth::user()->id));
                }
              }
            }
        }    

        return Redirect::to('ingresos-proveedor-create');
    }

//guarda los datos correspondientes, imprime, y borra temporal
    public function store() 
    {
//$entradas = DB::table('entradas')->where('usuario_id','=','1')->get(); 
      $cont = count($entradas = DB::table('entradas')->where('usuario_id','=', Auth::user()->id )->get());
      if($cont>0)
      {  
        $data = Input::all();
        //dd($data);
        $producto_id = DB::table('entradas')->select('producto_id')->where('usuario_id','=', Auth::user()->id )->pluck('producto_id');
        $proveedor_id = DB::table('productos')->select('provider_id')->where('id', '=', $producto_id)->pluck('provider_id');
    
        //$documento_id = $this->saveDocumento($proveedor_id); cambio por agregar campo de doc fisico
        $numdocfisico = $data['numdocfisico'];
        //dd($numdocfisico);
        //$documento_id = $this->saveDocumento($proveedor_id); cambio por agregar campo de doc fisico
        $documento_id = $this->saveDocumento($proveedor_id, $numdocfisico);
        foreach($data as $key=>$value)
        {
            if($key=='producto_id')
            {
                foreach($value as $key2=>$producto_id)
                {
                    DB::table('productos')->where('id','=',$data['producto_id'][$key2])
                                          ->update(array('preciocompra' => $data['preciocompra'][$key2]));

                    for ($i = 1; $i <= $data['cantidad'][$key2]; $i++) 
                    {
                        $preciocompra = $data['preciocompra'][$key2];

                        $mercaderia_id = $this->saveMercaderia($producto_id, $preciocompra);
                        $this->saveMovimientos($mercaderia_id,$documento_id);
                    }
                }
            }
        }
        $this->imprimeguia();
  
        //no llega hasta esta funcion se queda en la descarga de excel    
        return Redirect::to('ingresos-proveedor');
      }  
      return Redirect::to('ingresos-proveedor');
    }

    private function saveDocumento($proveedor_id, $numdocfisico)
    {

        $documento = new Documento();
        $documento->tipomovimiento_id = 1;// tipo de movimiento es ingreso 1
        $documento->fechadocumento = date('Y-m-d');
        $documento->numdocfisico = $numdocfisico; //agrega numdocfisico
//usuario logueado        
        $documento->usuario_id = Auth::user()->id;
        $documento->flagestado = 'ACT';
        $documento->localini_id = $proveedor_id;  //Para tipo de mov 1 ingresamos cod proveedor
        $documento->localfin_id = 1;
        $documento->save();
        return $documento->id;
    }

    private function saveMercaderia($producto_id, $preciocompra)
    {

        $mercaderia = new Mercaderia();
        $mercaderia->producto_id = $producto_id;
        $mercaderia->local_id = 1;
        $mercaderia->estado = 'ACT';
        $mercaderia->preciocompra = $preciocompra;
        $mercaderia->precioventa = 0;
//usuario logueado        
        $mercaderia->usuario_id = Auth::user()->id;
        $mercaderia->save();
        return $mercaderia->id;
    }


    private function saveMovimientos($mercaderia_id,$documento_id)
    {

        $movimiento = new Movimiento();
        $movimiento->mercaderia_id = $mercaderia_id;
        $movimiento->documento_id = $documento_id;
        //$movimiento->tipodocumento_id = 1; // liberar al cambiar BD
        $movimiento->flagoferta = 0;
        $movimiento->save();

    }
    public function getDelete($id)
    {
      //data = Input::all();
      DB::table('entradas')->where('id', '=', $id)->delete();

          $entradas = DB::table('entradas')->where('usuario_id','=', Auth::user()->id )->get();//usuario logueado

      return Redirect::to('ingresos-proveedor');

    }

    public function imprimeguia()
    {

          Excel::create(date('Y-m-d').'guiaentrada', function($excel)
          {

                // Set the title
            $excel->setTitle('Guia de entrada');
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
              $sheet->setColumnFormat(array( 'D' => '0.00' ));
              $sheet->setColumnFormat(array( 'E' => '0.00' ));
              $sheet->setColumnFormat(array( 'F' => '0.00' ));
              //Buscamos datos
              // cambio por agregar tipo de doc
              $documento_id = DB::table('documentos')->select('id')->where('tipomovimiento_id', '=', '1')->orderBy('id', 'desc')->pluck('id'); 
              $numdocfisico =  DB::table('documentos')->select('numdocfisico')->where('id', '=', $documento_id)->where('tipomovimiento_id', '=', '1')->pluck('numdocfisico'); //agrega numdocfisico
//usuario logueado
              $entradas = DB::table('entradas')->where('usuario_id','=',Auth::user()->id)->get(); 
//usuario logueado  
              $producto_id = DB::table('entradas')->select('producto_id')->where('usuario_id','=', Auth::user()->id)->pluck('producto_id');
              $proveedor_id = DB::table('productos')->select('provider_id')->where('id', '=', $producto_id)->pluck('provider_id');
              $desprovider = DB::table('providers')->select('desprovider')->where('id', '=', $proveedor_id)->pluck('desprovider');
              //        dd($desprovider);
               
              //dd($mercaderias[0]->id);   $mercaderias[$i]->codproducto31 
              //$sheet->row(2, array($mercaderias[0]->codproducto31, $mercaderias[1]->codproducto31,$mercaderias[2]->codproducto31 ));
              $cont = Count($entradas)-1; //por empezar indice 0
              $sheet->row(1, array('EMBAJADOR SHOES'));
                  $sheet->cell('A1', function($cell) { $cell->setFontSize(26); $cell->setFontWeight('bold'); });

              $sheet->row(3, array('GUIA DE ENTRADA'));
                  $sheet->cell('A3', function($cell) { $cell->setFontSize(20); $cell->setFontWeight('bold'); });
              //$sheet->row(5, array('Número de documento interno:   '. $documento_id, '')); agrega numdocfisico
              $sheet->row(5, array('Número de documento interno:   '. $documento_id, '', '', 'Documento Físico:  '. $numdocfisico));    

                  $sheet->cell('A5', function($cell) { $cell->setFontWeight('bold'); }); 
                  $sheet->cell('D5', function($cell) { $cell->setFontWeight('bold'); }); //agrega numdocfisico              
              $sheet->row(6, array('Proveedor:   '. $desprovider, '', '', '', 'Fecha :   '.date('Y-m-d')));
                  $sheet->cell('A6', function($cell) { $cell->setFontWeight('bold'); });
              $sheet->row(7, array('Generado por :   '. Auth::user()->desusuario));
                  $sheet->cell('A7', function($cell) { $cell->setFontWeight('bold'); });                 

                  $sheet->cell('E6', function($cell) { $cell->setFontWeight('bold'); });                 
              $sheet->row(9, array('CNT', 'PRODUCTO', 'DESCRIPCION', 'P. UNIT', 'P. ULTIMO', 'P. TOTAL' ));
                  $sheet->cells('A9:F9', function($cells) { $cells->setBackground('#FFFF00'); });

              $fila = 10;
              $numitems = 0;
              $preciototal = 0;
              for($i=0; $i<=$cont; )
                {
                    $sheet->row($fila, array($entradas[$i]->cantidad, $entradas[$i]->producto_id, $entradas[$i]->codproducto31, $entradas[$i]->preciocompra, $entradas[$i]->ultimoprecio, $entradas[$i]->cantidad * $entradas[$i]->preciocompra ));
                    if($entradas[$i]->preciocompra > $entradas[$i]->ultimoprecio)
                    {
                      $sheet->cell('F'.$fila, function($cell) { $cell->setFontWeight('bold'); $cell->setFontColor('#FE2E2E'); });
                    }
                    elseif($entradas[$i]->preciocompra < $entradas[$i]->ultimoprecio)
                    {
                      $sheet->cell('F'.$fila, function($cell) { $cell->setFontWeight('bold'); $cell->setFontColor('#2E2EFE'); });
                    } 

                    $numitems =$numitems + $entradas[$i]->cantidad;
                    $preciototal = $preciototal + $entradas[$i]->cantidad * $entradas[$i]->preciocompra;
                    $fila=$fila+1;
                    $i=$i+1;
                }    
              $fila=$fila+2;
              $sheet->row($fila, array($numitems, 'ITEMS EN TOTAL', '', '', 'TOTALES :', $preciototal ));
                $sheet->cell('F'. $fila, function($cell) { $cell->setBackground('#FFFF00'); });
            });

//segunda hoja
            $excel->sheet('Hoja2', function($sheet)
            {
              $sheet->setPageMargin(array( 0.2, 0.2, 0.2, 0.2 ));
              $sheet->freezeFirstRow();
              $sheet->setWidth('A',50);
              $sheet->setWidth('B',50);
              $sheet->setWidth('C',50);
              $sheet->setHeight(1,20);

              $sheet->setStyle(array( 'font' => array('name' => 'Bodoni MT Condensed','size' => 20,'bold' => false )));

              $mercaderias = new Mercaderia;
              //obtener datos
              $documento_id = DB::table('documentos')->select('id')->where('tipomovimiento_id', '=', '1')->orderBy('id', 'desc')->pluck('id');  
              $numdocfisico =  DB::table('documentos')->select('numdocfisico')->where('id', '=', $documento_id)->where('tipomovimiento_id', '=', '1')->pluck('numdocfisico'); //agrega numdocfisico

              $mercaderias = DB::table('mercaderias')->join('movimientos','mercaderias.id','=','movimientos.mercaderia_id')
                                        ->join('productos','mercaderias.producto_id','=','productos.id')
                                        ->join('documentos', 'movimientos.documento_id','=','documentos.id')
                  ->select('mercaderias.id',
                           'movimientos.documento_id',
                           'mercaderias.producto_id',
                           'mercaderias.estado',
                           'mercaderias.preciocompra',
                           'productos.codproducto31')
                  ->where('documentos.tipomovimiento_id','=','1')
                  ->orderBy('productos.codproducto31', 'asc')
                  ->orderBy('mercaderias.id', 'asc')
                  ->where('movimientos.documento_id','=', $documento_id)
                  ->get(); 
               
              //dd($mercaderias[0]->id);   $mercaderias[$i]->codproducto31 
              //$sheet->row(2, array($mercaderias[0]->codproducto31, $mercaderias[1]->codproducto31,$mercaderias[2]->codproducto31 ));
              $cont = Count($mercaderias) ;
              $sheet->row(1, array('GUIA ENTRADA :'. $documento_id, 'CANTIDAD :'. $cont, 'NUM Doc Físico : '.$numdocfisico));              
              $fila=2;
              $cont=$cont - 1;
              for($i=0; $i<=$cont; ){

                  $sheet->cell('A'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); });
                  $sheet->cell('B'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); });
                  $sheet->cell('C'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); });
                  if($i+1>$cont){
                      $sheet->row($fila, array($mercaderias[$i]->codproducto31 ));
                      $sheet->setHeight($fila, 84);
                      $fila=$fila+1;
                      $sheet->cell('A'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                      $sheet->cell('B'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                      $sheet->cell('C'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                      $sheet->row($fila, array('*'. $mercaderias[$i]->id .'*' ));
                      break;
                  }    
                  if($i+2>$cont){
                      $sheet->row($fila, array($mercaderias[$i]->codproducto31, $mercaderias[$i+1]->codproducto31 ));
                      $sheet->setHeight($fila, 84);
                      $fila=$fila+1;
                      $sheet->cell('A'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                      $sheet->cell('B'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                      $sheet->cell('C'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                      $sheet->row($fila, array('*'. $mercaderias[$i]->id .'*', '*'. $mercaderias[$i+1]->id .'*' ));
                      break;
                  }
              
                  $sheet->row($fila, array($mercaderias[$i]->codproducto31, $mercaderias[$i+1]->codproducto31,$mercaderias[$i+2]->codproducto31 ));
                  $sheet->setHeight($fila, 84);
                  $fila=$fila+1;
                  $sheet->cell('A'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                  $sheet->cell('B'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                  $sheet->cell('C'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                  $sheet->row($fila, array('*'. $mercaderias[$i]->id .'*', '*'. $mercaderias[$i+1]->id .'*', '*'. $mercaderias[$i+2]->id .'*' ));
                  $sheet->setHeight($fila, 84);
                  $i=$i+3;
                  
                  $fila=$fila+1;
              }
              $sheet->setHeight($fila, 84); //ultima fila aparece 128.25
            });
//termina segunda hoja
//usuario logueado
            //Elimina tabla temporal
            DB::table('entradas')->where('usuario_id','=', Auth::user()->id )->delete();  

          })->download('xlsx');

    }


}
