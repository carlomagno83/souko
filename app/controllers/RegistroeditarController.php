<?php

class RegistroeditarController extends BaseController {

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
		return View::make('registroeditar.registroeditar'); //->with('devuelves', $devuelves);
	}

    public function buscar()
    {   
        if(Input::get('documento_id')!=null )
        {
            $documento_id = DB::table('documentos')->select('id')->where('id', '=', Input::get('documento_id'))->where('tipomovimiento_id', '=', '3')->pluck('id');
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
                            ->where('movimientos.tipomovimiento_id', '=', '3')
                            ->select('mercaderias.id', 'productos.codproducto31', 'mercaderias.local_id', 'locals.deslocal', 'mercaderias.estado','mercaderias.preciocompra', 'productos.precioventa AS preciosugerido','mercaderias.precioventa', 'mercaderias.usuario_id', 'users.desusuario')
                            ->get();
                $documentos = DB::table('documentos')
                            ->join('locals', 'locals.id', '=', 'documentos.localfin_id')
                            ->join('users', 'documentos.usuario_id', '=', 'users.id')
                            ->where('documentos.id', '=', Input::get('documento_id'))->where('tipomovimiento_id', '=', '3')
                            ->select('documentos.id', 'fechadocumento', 'localfin_id', 'deslocal','flagestado', 'documentos.usuario_id', 'desusuario')
                            ->get();


                    return View::make('registroeditar.registroeditarventa')
                            ->withInput('documento_id', 'tipomovimiento_id')
                            ->with('devuelves', $devuelves)
                            ->with('documentos', $documentos);

            }
            return View::make('registroeditar.registroeditar')->withErrors(['Número de documento incorrecto']);
        }
        return View::make('registroeditar.registroeditar');

    }



    public function registroeditarventa()
    {
        $data = Input::all();
        foreach($data['id'] as $key=>$value)
        {
            DB::table('mercaderias')->where('id', '=', $data['id'][$key])
                                    ->update(array('precioventa' => $data['precioventa'][$key]));
        }
        return View::make('registroeditar.registroeditar')->withErrors(['Registro(s) actualizado(s)....']);
    }


}
?>