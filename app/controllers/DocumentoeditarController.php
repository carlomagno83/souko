<?php

class DocumentoeditarController extends BaseController {

    /**
     * devuelve Repository
     *
     * @var devuelve
     */
    protected $devuelve;
    protected $mercaderia;
    protected $documento;
    public function __construct(Devuelve $devuelve, Mercaderia $mercaderia, Documento $documento)
    {
        $this->devuelve = $devuelve;
        $this->mercaderia = $mercaderia;
        $this->documento = $documento;
    }


	public function index()
	{
//hay que cambiar por usuario logueado		
		//$devuelves = DB::table('devuelves')->find(0);
		return View::make('documentoeditar.documentoeditar'); //->with('devuelves', $devuelves);
	}

    public function buscar()
    {
        if(Input::get('documento_id')!=null And Input::get('tipomovimiento_id')!=null )
        {
            $documento_id = DB::table('documentos')->select('id')->where('id', '=', Input::get('documento_id'))->where('tipomovimiento_id', '=', Input::get('tipomovimiento_id'))->pluck('id');

            if($documento_id != null)
            {
                $devuelves = DB::table('documentos')
                            ->join('movimientos', function($join)
                                        {
                                    $join->on('documentos.id', '=',  'movimientos.documento_id');
                                    $join->on('documentos.tipomovimiento_id','=', 'movimientos.tipomovimiento_id');
                                        })
                            ->join('mercaderias', 'mercaderias.id', '=', 'movimientos.mercaderia_id')
                            ->join('productos', 'mercaderias.producto_id', '=', 'productos.id')
                            ->join('locals', 'locals.id', '=', 'mercaderias.local_id')
                            ->join('users', 'mercaderias.usuario_id', '=', 'users.id')
                            ->where('movimientos.documento_id', '=', Input::get('documento_id'))
                            ->where('movimientos.tipomovimiento_id', '=', Input::get('tipomovimiento_id'))
                            ->select('mercaderias.id', 'productos.codproducto31', 'mercaderias.local_id', 'locals.deslocal', 'mercaderias.estado','mercaderias.preciocompra', 'mercaderias.precioventa', 'mercaderias.usuario_id', 'users.desusuario')
                            ->get();
                $tipomovimiento_id = Input::get('tipomovimiento_id');
                $documentos = DB::table('documentos')
                            ->join('locals', 'locals.id', '=', 'documentos.localfin_id')
                            ->join('users', 'documentos.usuario_id', '=', 'users.id')
                            ->join('tipomovimientos', 'documentos.tipomovimiento_id', '=', 'tipomovimientos.id')
                            ->where('documentos.id', '=', Input::get('documento_id'))->where('tipomovimiento_id', '=', Input::get('tipomovimiento_id'))
                            ->select('documentos.id', 'fechadocumento', 'localfin_id', 'deslocal','flagestado', 'documentos.usuario_id', 'desusuario', 'documentos.created_at', 'destipomovimiento', 'tipomovimiento_id')
                            ->get();




                return View::make('documentoeditar.documentoeditardocumento')
                            ->withInput('documento_id', 'tipomovimiento_id')
                            ->with('devuelves', $devuelves)
                            ->with('documentos', $documentos);


            }
            return View::make('documentoeditar.documentoeditar')->withErrors(['Número de documento o Tipo de movimiento incorrecto']);
        }
        return View::make('documentoeditar.documentoeditar');

    }




    public function documentoeditardocumento()
    {
        $data = Input::all();

        DB::table('documentos')->where('id', '=', Input::get('documento_id'))
                                ->where('tipomovimiento_id', '=', Input::get('tipomovimiento_id'))
                                ->update(array('fechadocumento' => Input::get('fechadocumento'), 
                                                'created_at' => Input::get('created_at')));

        return View::make('documentoeditar.documentoeditar')->withErrors(['Documento editado ....']);
    }




}
?>
