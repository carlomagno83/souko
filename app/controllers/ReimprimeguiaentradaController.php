<?php

class ReimprimeguiaentradaController extends BaseController 
{
    /**
     * Color Repository
     *
     * @var Color
     */
    protected $mercaderia;

    public function __construct(Mercaderia $mercaderia)
    {
        $this->mercaderia = $mercaderia;
    }

	public function index()
	{
		$mercaderias = Mercaderia::find(0); //JAM
        //$mercaderias = new Mercaderia();
        //dd(count($mercaderias)); 
		return View::make('reimprimeguiaentrada.reimprimeguiaentrada')->with('mercaderias',$mercaderias);
	}

    //solo busca documentos con tipo de movimiento =1
    public function buscar()
    {
        if(Input::get('documento_id')!=null) 
        {    
            if(DB::table('documentos')->find(Input::get('documento_id')))
            {
                $documentos = DB::table('documentos')->find(Input::get('documento_id'));
                //dd($documentos);
                $mercaderias = $this->mercaderia->join('movimientos','mercaderias.id','=','movimientos.mercaderia_id')
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
                          ->where('movimientos.documento_id','=', Input::get('documento_id'))
                            
                          ->get();

                return View::make('reimprimeguiaentrada.reimprimeguiaentrada', compact('mercaderias'))->withInput('documento_id')->with('documentos',$documentos);
            }
        } 
        $mercaderias = Mercaderia::find(0);
        return View::make('reimprimeguiaentrada.reimprimeguiaentrada')->withInput('documento_id')->with('mercaderias',$mercaderias)->with('message','No se encuentra el documento');
    }

    public function buscarfisico()
    {

        if(Input::get('numdocfisico')!=null) 
        {    
            $documentos = Documento::where('numdocfisico', Input::get('numdocfisico'))->where('tipomovimiento_id','1')->firstOrFail();
            //dd($documentos);
            if($documentos)
            {
                
                $mercaderias = $this->mercaderia->join('movimientos','mercaderias.id','=','movimientos.mercaderia_id')
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
                          ->where('documentos.numdocfisico','=', Input::get('numdocfisico'))
                            
                          ->get();

                return View::make('reimprimeguiaentrada.reimprimeguiaentrada', compact('mercaderias'))->withInput('numdocfisico')->with('documentos',$documentos);
            }
        } 
        $mercaderias = Mercaderia::find(0);
        return View::make('reimprimeguiaentrada.reimprimeguiaentrada')->withInput('documento_id')->with('mercaderias',$mercaderias)->with('message','No se encuentra el documento');
    }

    public function reimprime()
    {
        $data = Input::all();
        $numdoc = $data['documento_id'];
          Excel::create('ReimprimeEtqta', function($excel)
          {
                // Set the title
            $excel->setTitle('Re-impresión de Etiquetas');
            $excel->sheet('Hoja1', function($sheet)
            {
              $sheet->setPageMargin(array( 0.2, 0.2, 0.2, 0.2 ));
              $sheet->freezeFirstRow();
              $sheet->setWidth('A',50);
              $sheet->setWidth('B',50);
              $sheet->setWidth('C',50);
              $sheet->setHeight(1,20);


              $sheet->setStyle(array( 'font' => array('name' => 'Bodoni MT Condensed','size' => 16,'bold' => false )));

              $mercaderias = new Mercaderia;

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
                  ->where('movimientos.documento_id','=', Input::get('documento_id'))
                  ->get(); 
               
              //dd($mercaderias[0]->id);   $mercaderias[$i]->codproducto31 
              //$sheet->row(2, array($mercaderias[0]->codproducto31, $mercaderias[1]->codproducto31,$mercaderias[2]->codproducto31 ));
              $cont = Count($mercaderias) ;
              $sheet->row(1, array('GUIA ENTRADA :'. Input::get('documento_id'), 'CANTIDAD :'. $cont));              
              $fila=2;
              $cont=$cont - 1;
              for($i=0; $i<=$cont; ){

                  $sheet->cell('A'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('top'); });
                  $sheet->cell('B'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('top'); });
                  $sheet->cell('C'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('top'); });
                  if($i+1>$cont){
                      $sheet->row($fila, array($mercaderias[$i]->codproducto31 ));
                      $sheet->setHeight($fila, 85);
                      $fila=$fila+1;
                      $sheet->cell('A'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                      $sheet->cell('B'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                      $sheet->cell('C'.$fila, function($cell) { $cell->setAlignment('center'); $cell->setValignment('center'); $cell->setFontFamily('MRV Code39MA Free'); $cell->setFontSize(22); });
                      $sheet->row($fila, array('*'. $mercaderias[$i]->id .'*' ));
                      break;
                  }    
                  if($i+2>$cont){
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

              //$sheet->fromArray($mercaderias);.$fila
              /*$fecha_ini = $_POST["fecha_ini_txt"];
              $fecha_fin = $_POST["fecha_fin_txt"];
              $movimientos = new Movimiento;
              $movimientos = $this->Datos($fecha_ini ,$fecha_fin);
              $sheet->fromArray($movimientos);*/
            });
          })->download('xlsx');

    }




}
?>
