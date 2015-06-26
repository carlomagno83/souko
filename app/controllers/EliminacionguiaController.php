<?php

class EliminacionguiaController extends BaseController 
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
		return View::make('eliminacionguia.eliminacionguia')->with('mercaderias',$mercaderias);
	}

    public function create()
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

                return View::make('eliminacionguia.eliminacionguia', compact('mercaderias'))->withInput('documento_id')->with('documentos',$documentos);
            }
        } 
        $mercaderias = Mercaderia::find(0);
        return View::make('eliminacionguia.eliminacionguia')->withInput('documento_id')->with('mercaderias',$mercaderias)->with('message','No se encuentra el documento');
    }

    public function store()
    {
        $data = Input::all();
        // hay que agregar un control de txn
        DB::table('movimientos')->where('documento_id', '=', Input::get('documento_id'))->delete();
        
        foreach($data['id'] as $key=>$value)
        {
            //echo $data['id'][$key];
            DB::table('mercaderias')->where('id', '=', $data['id'][$key])->delete();
        }
        DB::table('documentos')->where('id', '=', Input::get('documento_id'))->delete();

        $mercaderias = Mercaderia::find(0);
        return View::make('eliminacionguia.eliminacionguia')->with('mercaderias',$mercaderias)->with('message','Guia de Entrada Eliminada');

    }


}	
?>
