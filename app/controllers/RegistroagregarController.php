<?php

class RegistroagregarController extends BaseController {

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
		return View::make('registroagregar.registroagregar'); //->with('devuelves', $devuelves);
	}

    public function buscar()
    {
        if(Input::get('documento_id')!=null And Input::get('tipomovimiento_id')!=null And Input::get('mercaderia_id')!=null)
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
                            ->select('mercaderias.id', 'productos.codproducto31', 'mercaderias.local_id', 'locals.codlocal3', 'mercaderias.estado','mercaderias.preciocompra', 'mercaderias.precioventa', 'mercaderias.usuario_id', 'users.desusuario')
                            ->get();
                $tipomovimiento_id = Input::get('tipomovimiento_id');
                $documentos = DB::table('documentos')
                            ->join('locals', 'locals.id', '=', 'documentos.localfin_id')
                            ->join('users', 'documentos.usuario_id', '=', 'users.id')
                            ->where('documentos.id', '=', Input::get('documento_id'))->where('tipomovimiento_id', '=', Input::get('tipomovimiento_id'))
                            ->select('documentos.id', 'fechadocumento', 'localfin_id', 'codlocal3','flagestado', 'documentos.usuario_id', 'desusuario')
                            ->get();

                $mercaderias = DB::table('mercaderias')
                                ->join('productos', 'mercaderias.producto_id', '=', 'productos.id')
                                ->join('locals', 'locals.id', '=', 'mercaderias.local_id')
                                ->join('users', 'mercaderias.usuario_id', '=', 'users.id')
                                ->where('mercaderias.id', '=', Input::get('mercaderia_id'))
                                ->select('mercaderias.id', 'productos.codproducto31', 'mercaderias.local_id', 'locals.codlocal3', 'mercaderias.estado','productos.precioventa', 'mercaderias.usuario_id', 'users.desusuario')
                                ->get();

                if($mercaderias != null)
                {  
                    if( $tipomovimiento_id == "3") 
                    {
                        return View::make('registroagregar.registroagregarventa')
                                ->withInput('documento_id', 'tipomovimiento_id')
                                ->with('devuelves', $devuelves)
                                ->with('documentos', $documentos)
                                ->with('mercaderias', $mercaderias);
                    }
                    elseif ($tipomovimiento_id == "4") 
                    {
                        return View::make('registroagregar.registroagregartrasladopto')->with('devuelves', $devuelves)->with('documentos', $documentos)->with('mercaderias', $mercaderias);
                    }
                    //por ultimo si el tipo movimiento es 2
                    return View::make('registroagregar.registroagregartrasladoalm')->with('devuelves', $devuelves)->with('documentos', $documentos)->with('mercaderias', $mercaderias);
                }
                return View::make('registroagregar.registroagregar')->withErrors(['Número de mercadería no encontrado']);
            }
            return View::make('registroagregar.registroagregar')->withErrors(['Número de documento o Tipo de movimiento incorrecto']);
        }
        return View::make('registroagregar.registroagregar');

    }



    public function consultamercaderia($cod)
    {
        //$mercaderia = Mercaderia::find($cod);
        $mercaderias = DB::select("SELECT movimientos.documento_id AS Numdoc, movimientos.tipomovimiento_id, devolucion, tipomovimientos.destipomovimiento, locals.codlocal3, documentos.fechadocumento , documentos.created_at
                        from movimientos
                        INNER JOIN tipomovimientos ON tipomovimientos.id = movimientos.tipomovimiento_id
                        INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
                        INNER JOIN locals ON locals.id = documentos.localfin_id
                        WHERE movimientos.mercaderia_id = '$cod'
                        ORDER BY documentos.created_at");
        $detalles = DB::select("SELECT mercaderias.id, productos.codproducto31, mercaderias.estado, mercaderias.preciocompra, mercaderias.precioventa
                        from mercaderias
                        INNER JOIN productos ON productos.id = mercaderias.producto_id
                        WHERE mercaderias.id = '$cod'");

        return View::make('registroagregar.consultamercaderia')->with('mercaderias', $mercaderias)->with('detalles', $detalles);

    }


    public function registroagregarventa()
    {
        $data = Input::all();

        $vende_id = DB::table('movimientos')->join('mercaderias', 'mercaderias.id', '=', 'movimientos.mercaderia_id')->select('mercaderias.usuario_id')->where('documento_id', '=', Input::get('documento_id'))->where('tipomovimiento_id', '=', 3)->pluck('mercaderias.usuario_id');
        //dd($vende_id);
        DB::table('mercaderias')->where('id', '=', Input::get('mercaderia_id'))
                                ->update(array('estado' => 'VEN', 'precioventa' => Input::get('precioventaregistro'), 'usuario_id' => $vende_id));
        //DB::table('movimientos')->insert(array('tipomovimiento_id' => '3', 'mercaderia_id' => Input::get('mercaderia_id'), 'documento_id' => Input::get('documento_id'))); 
        $movimiento = new Movimiento();
        $movimiento->mercaderia_id = Input::get('mercaderia_id');
        $movimiento->documento_id = Input::get('documento_id');
        $movimiento->tipomovimiento_id = 3; //cambio tipo movimiento
        $movimiento->flagoferta = 0;
        $movimiento->save();   
        return View::make('registroagregar.registroagregar')->withErrors(['Registro agregado ....']);
    }


    public function registroagregartrasladoalm()
    {
        $data = Input::all();

        DB::table('mercaderias')->where('id', '=', Input::get('mercaderia_id'))
        //                        ->update(array('estado' => 'VEN', 'precioventa' => Input::get('precioventaregistro')));
                                ->update(array('local_id' => Input::get('localfin_id'), 'usuario_id' => Input::get('usuario_id')));
        //DB::table('movimientos')->insert(array('tipomovimiento_id' => '3', 'mercaderia_id' => Input::get('mercaderia_id'), 'documento_id' => Input::get('documento_id')));

        $movimiento = new Movimiento();
        $movimiento->mercaderia_id = Input::get('mercaderia_id');
        $movimiento->documento_id = Input::get('documento_id');
        $movimiento->tipomovimiento_id = 2; //cambio tipo movimiento
        $movimiento->flagoferta = 0;
        $movimiento->save();  
        //dd("agrega reg"); 
        return View::make('registroagregar.registroagregar')->withErrors(['Registro agregado ....']);
    }


    public function registroagregartrasladopto()
    {

        $data = Input::all();

        DB::table('mercaderias')->where('id', '=', Input::get('mercaderia_id'))
                                ->update(array('local_id' => Input::get('localfin_id'), 'usuario_id' => Input::get('usuario_id')));
        //DB::table('movimientos')->insert(array('tipomovimiento_id' => '3', 'mercaderia_id' => Input::get('mercaderia_id'), 'documento_id' => Input::get('documento_id'))); 
        $movimiento = new Movimiento();
        $movimiento->mercaderia_id = Input::get('mercaderia_id');
        $movimiento->documento_id = Input::get('documento_id');
        $movimiento->tipomovimiento_id = 4; //cambio tipo movimiento
        $movimiento->flagoferta = 0;
        $movimiento->save();   
        return View::make('registroagregar.registroagregar')->withErrors(['Registro agregado ....']);
    }


}
?>
