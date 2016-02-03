<?php

class LiquidacionguiadevController extends BaseController {

    /**
     * Producto Repository
     *
     * @var Producto
     */
    protected $documento;

    public function __construct(Documento $documento)
    {
        $this->documento = $documento;
    }

	public function index()
	{
		$documentos = DB::table('documentos')->join('providers','documentos.localfin_id','=','providers.id')
											->join('movimientos', 'documentos.id', '=', 'movimientos.documento_id')
											->join('mercaderias', 'mercaderias.id', '=', 'movimientos.mercaderia_id')
											->select('documentos.id',
											'documentos.fechadocumento',
											'providers.desprovider',
											DB::raw('sum(preciocompra) AS totalcompra'),
											DB::raw('count(preciocompra) AS totalitem'))
										->where('flagestado', '=', 'ACT')
										->where('tipomovimiento_id', '=', 7)
										->groupBy('documentos.id')
										->orderBy('documentos.fechadocumento')
										->get();

		return View::make('liquidacionguiadev.liquidacionguiadev')->with('documentos', $documentos); 



	}

    public function store()
    {
        $data = Input::all();
        $numguias = '';
        foreach($data as $key=>$value)
        {
            if($key=='checkbox')
            { 
                foreach($value as $key2=>$indice)
                {

                    //dd($key2); //el key2 muestra el indice                       
                	$numguias = $numguias. 'Número. '.$data['id'][$key2]. ' ';
					DB::table('mercaderias')->join('movimientos', 'mercaderias.id', '=', 'movimientos.mercaderia_id')
											->where('movimientos.documento_id', '=', $data['id'][$key2])
											->update(array('estado' => 'BAJ'));
					DB::table('documentos')->where('documentos.id', '=', $data['id'][$key2])
											->update(array('flagestado' => 'BAJ', 'usuario_id' =>  Auth::user()->id ));
                }
            }
        }
        $documentos = DB::table('documentos')->join('providers','documentos.localfin_id','=','providers.id')
											->join('movimientos', 'documentos.id', '=', 'movimientos.documento_id')
											->join('mercaderias', 'mercaderias.id', '=', 'movimientos.mercaderia_id')
											->select('documentos.id',
											'documentos.fechadocumento',
											'providers.desprovider',
											DB::raw('sum(preciocompra) AS totalcompra'),
											DB::raw('count(preciocompra) AS totalitem'))
										->where('flagestado', '=', 'ACT')
										->where('tipomovimiento_id', '=', 7)
										->groupBy('documentos.id')
										->orderBy('documentos.fechadocumento')
										->get();
		return View::make('liquidacionguiadev.liquidacionguiadev')->with('documentos', $documentos)->withErrors('Datos Procesados, cancelar guía(s) seleccionada(s)'. $numguias );
        //$devueltos = DB::table('devueltos')->where('usuario_id','=',1)->get();//hay que cambiar por usuario logueado
        //return View::make('generaguiadev.generaguiadev', compact('mercaderias'))->with('devueltos', $devueltos);


    }


}	
?>
