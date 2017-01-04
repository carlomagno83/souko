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
                            ->select('mercaderias.id', 'productos.codproducto31', 'mercaderias.local_id', 'locals.codlocal3',
                                'mercaderias.usuario_id as vende_id',
                             'mercaderias.estado','mercaderias.preciocompra', 'productos.precioventa AS preciosugerido','mercaderias.precioventa', 'mercaderias.usuario_id', 'users.desusuario', 'devolucion')
                            ->get();
                $documentos = DB::table('documentos')
                            ->join('locals', 'locals.id', '=', 'documentos.localfin_id')
                            ->join('users', 'documentos.usuario_id', '=', 'users.id')
                            ->where('documentos.id', '=', Input::get('documento_id'))->where('tipomovimiento_id', '=', '3')
                            ->select('documentos.id', 'fechadocumento', 'localfin_id', 'codlocal3','flagestado', 'documentos.usuario_id', 'desusuario')
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
//dd($data['vende_id']);
        foreach($data['id'] as $key=>$value)
        {
            if( $data['precioventa'][$key] >= 0 )
            {    
            DB::table('mercaderias')->where('id', '=', $data['id'][$key])
                                    ->update(array('precioventa' => $data['precioventa'][$key],
                                        'usuario_id' => $data['vende_id']));
            }
            else
            {
                DB::table('mercaderias')->where('id', '=', $data['id'][$key])
                                    //->update(array('precioventa' => $data['precioventa'][$key],
                                    //    'usuario_id' => $data['vende_id']));
                                    ->update(array('usuario_id' => $data['vende_id']));
                DB::table('movimientos')->where('mercaderia_id', '=', $data['id'][$key])->where('tipomovimiento_id', '=', 3)->where('devolucion', '<', 0)->update(array('devolucion' => $data['precioventa'][$key]));                 
            }                        
        }
        return View::make('registroeditar.registroeditar')->withErrors(['Registro(s) actualizado(s)....']);
    }


}
?>
