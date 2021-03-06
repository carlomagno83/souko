<?php

class IngresoeditarController extends BaseController {

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
		return View::make('ingresoeditar.ingresoeditar'); //->with('devuelves', $devuelves);
	}

    public function buscar()
    {   
        if(Input::get('documento_id')!=null )
        {
            $documento_id = DB::table('documentos')->select('id')->where('id', '=', Input::get('documento_id'))->where('tipomovimiento_id', '=', '1')->pluck('id');
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
                            ->where('movimientos.tipomovimiento_id', '=', '1')
                            ->select('mercaderias.id', 'productos.codproducto31', 'mercaderias.local_id', 'locals.codlocal3', 'mercaderias.estado','mercaderias.preciocompra', 'productos.precioventa AS preciosugerido','mercaderias.precioventa', 'mercaderias.usuario_id', 'users.desusuario', 'devolucion')
                            ->get();
                $documentos = DB::table('documentos')
                            ->join('movimientos', function($join)
                                        {
                                    $join->on('documentos.id', '=',  'movimientos.documento_id');
                                    $join->on('documentos.tipomovimiento_id','=', 'movimientos.tipomovimiento_id');
                                        })
                            ->join('mercaderias', 'mercaderias.id', '=', 'movimientos.mercaderia_id')
                            ->join('locals', 'locals.id', '=', 'documentos.localfin_id')
                            ->join('users', 'documentos.usuario_id', '=', 'users.id')
                            ->where('documentos.id', '=', Input::get('documento_id'))->where('documentos.tipomovimiento_id', '=', '1')
                            ->select('documentos.id', 'fechadocumento', 'localfin_id', 'codlocal3','flagestado', 'documentos.usuario_id', 'desusuario', DB::raw('sum(mercaderias.preciocompra) as totalcompra'))
                            ->get();


                    return View::make('ingresoeditar.ingresoeditarcompra')
                            ->withInput('documento_id', 'tipomovimiento_id')
                            ->with('devuelves', $devuelves)
                            ->with('documentos', $documentos);

            }
            return View::make('ingresoeditar.ingresoeditar')->withErrors(['Número de documento incorrecto']);
        }
        return View::make('ingresoeditar.ingresoeditar');

    }



    public function ingresoeditarcompra()
    {
        $data = Input::all();
        //dd($data);

        foreach($data['id'] as $key=>$value)
        {
            if( $data['preciocompra'][$key] >= 0 )
            {    
            DB::table('mercaderias')->where('id', '=', $data['id'][$key])
                                    ->update(array('preciocompra' => $data['preciocompra'][$key]));
            }
                   
        }
        return View::make('ingresoeditar.ingresoeditar')->withErrors(['Registro(s) actualizado(s)....']);
    }


}
?>
