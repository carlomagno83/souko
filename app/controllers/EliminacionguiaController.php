<?php

class EliminacionguiaController extends BaseController 
{
    /**
     * Color Repository
     *
     * @var Color
     */
    protected $mercaderia;
    protected $documento;

    public function __construct(Mercaderia $mercaderia, Documento $documento)
    {
        $this->mercaderia = $mercaderia;
        $this->documento = $documento;
    }

  	public function index()
  	{
            $mercaderias = Mercaderia::find(0); //JAM
            $documentos = Documento::find(0); //JAM

    		return View::make('eliminacionguia.eliminacionguia')->with('mercaderias',$mercaderias)->with('documentos',$documentos);
  	}

    public function create()
    {
        if(Input::get('documento_id')!=null) 
        {    
            //$documentos = Documento::where('numdocfisico', Input::get('numdocfisico'))->where('tipomovimiento_id','1')->firstOrFail();
            $documentos = $this->documento->where('id', Input::get('documento_id'))->where('tipomovimiento_id','1')->get();

            if(count($documentos) > 0)
            {
                $mercaderias = $this->mercaderia->join('movimientos','mercaderias.id','=','movimientos.mercaderia_id')
                                                ->join('productos','mercaderias.producto_id','=','productos.id')
                                                ->join('documentos', function($join)
                                                              {
                                                        $join->on('documentos.id', '=',  'movimientos.documento_id');
                                                        $join->on('documentos.tipomovimiento_id','=', 'movimientos.tipomovimiento_id');
                                                              })
                                                ->join('locals', 'mercaderias.local_id','=','locals.id')
                            ->select('mercaderias.id',
                                    'movimientos.documento_id',
                                    'mercaderias.producto_id',
                                    'mercaderias.estado',
                                    'mercaderias.preciocompra',
                                    'productos.codproducto31',
                                    'locals.deslocal')
                            ->where('documentos.tipomovimiento_id','=','1')
                            ->orderBy('productos.codproducto31', 'asc')
                            ->orderBy('mercaderias.id', 'asc')
                            ->where('movimientos.documento_id','=', Input::get('documento_id'))
                              
                            ->get();

                return View::make('eliminacionguia.eliminacionguia', compact('mercaderias'))->withInput('documento_id')->with('documentos',$documentos);
            }
        } 
        $mercaderias = Mercaderia::find(0);
        $documentos = Documento::find(0);
        return View::make('eliminacionguia.eliminacionguia')->withInput('documento_id')->with('mercaderias',$mercaderias)->with('documentos',$documentos)->withErrors(['Número de documento incorrecto']);
    }



    public function createfisico()
    {
        if(Input::get('numdocfisico')!=null) 
        {    

                //$documentos = DB::table('documentos')->where('numdocfisico', '=', Input::get('numdocfisico'))
                //                                     ->where('tipomovimiento_id', '=', '1')
                //                                    ->get();
                

            //$documentos = Documento::where('numdocfisico', Input::get('numdocfisico'))->where('tipomovimiento_id','1')->firstOrFail();
            $documentos = $this->documento->where('numdocfisico', Input::get('numdocfisico'))->where('tipomovimiento_id','1')->get();

                //dd($documentos);
            if(count($documentos) > 0)
            {
                //$documentos = DB::table('documentos')->find(Input::get('numdocfisico'));
                
                $mercaderias = $this->mercaderia->join('movimientos','mercaderias.id','=','movimientos.mercaderia_id')
                                                ->join('productos','mercaderias.producto_id','=','productos.id')
                                                ->join('documentos', function($join)
                                                              {
                                                        $join->on('documentos.id', '=',  'movimientos.documento_id');
                                                        $join->on('documentos.tipomovimiento_id','=', 'movimientos.tipomovimiento_id');
                                                              })
                                                ->join('locals', 'mercaderias.local_id','=','locals.id')
                            ->select('mercaderias.id',
                                    'movimientos.documento_id',
                                    'mercaderias.producto_id',
                                    'mercaderias.estado',
                                    'mercaderias.preciocompra',
                                    'productos.codproducto31',
                                    'locals.deslocal')
                            ->where('documentos.tipomovimiento_id','=','1')
                            ->orderBy('productos.codproducto31', 'asc')
                            ->orderBy('mercaderias.id', 'asc')
                            ->where('documentos.numdocfisico','=', Input::get('numdocfisico'))
                              
                            ->get();

                //return View::make('eliminacionguia.eliminacionguia', compact('mercaderias'))->withInput('numdocfisico')->with('documentos',$documentos);
                return View::make('eliminacionguia.eliminacionguia', compact('mercaderias'))->withInput('numdocfisico')->with('documentos', $documentos);
            }
        } 
        $mercaderias = Mercaderia::find(0);
        $documentos = Documento::find(0);
        return View::make('eliminacionguia.eliminacionguia')->withInput('numdocfisico')->with('mercaderias',$mercaderias)->with('documentos',$documentos)->withErrors(['Número de documento incorrecto']);
    }

    public function store()
    {
        $data = Input::all();
        // hay que agregar un control de txn
        DB::table('movimientos')->where('documento_id', '=', Input::get('documento_id'))
                                ->where('tipomovimiento_id', '=', '1')
                                ->delete();
        
        foreach($data['id'] as $key=>$value)
        {
            //echo $data['id'][$key];
            DB::table('mercaderias')->where('id', '=', $data['id'][$key])->delete();
        }
        DB::table('documentos')->where('id', '=', Input::get('documento_id'))
                                ->where('tipomovimiento_id', '=', '1')
                                ->delete();

        $mercaderias = Mercaderia::find(0);
        $documentos = Documento::find(0); //JAM        
        return View::make('eliminacionguia.eliminacionguia')->with('mercaderias',$mercaderias)->with('documentos',$documentos)->withErrors(['Guía de Entrada Eliminada, por favor destruya el documento Físico: '. Input::get('documento_id')]);

    }


}	
?>
