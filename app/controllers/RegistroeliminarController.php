<?php

class RegistroeliminarController extends BaseController {

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


//en el caso de eliminar, solo es posible cuando el doc corresponde al ultimo movimiento realizado para la mrecaderia a eliminar, 

	public function index()
	{
//hay que cambiar por usuario logueado		
		//$devuelves = DB::table('devuelves')->find(0);
		return View::make('registroeliminar.registroeliminar'); //->with('devuelves', $devuelves);
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
                            ->select('mercaderias.id', 'productos.codproducto31', 'mercaderias.local_id', 'locals.deslocal', 'mercaderias.estado','mercaderias.preciocompra', 'mercaderias.precioventa', 'mercaderias.usuario_id', 'users.desusuario')
                            ->get();
                $tipomovimiento_id = Input::get('tipomovimiento_id');
                $documentos = DB::table('documentos')
                            ->join('locals', 'locals.id', '=', 'documentos.localfin_id')
                            ->join('users', 'documentos.usuario_id', '=', 'users.id')
                            ->where('documentos.id', '=', Input::get('documento_id'))->where('tipomovimiento_id', '=', Input::get('tipomovimiento_id'))
                            ->select('documentos.id', 'fechadocumento', 'documentos.tipomovimiento_id', 'localfin_id', 'deslocal','flagestado', 'documentos.usuario_id', 'desusuario')
                            ->get();

                $mercaderias = DB::table('documentos')
                            ->join('movimientos', function($join)
                                        {
                                    $join->on('documentos.id', '=',  'movimientos.documento_id');
                                    $join->on('documentos.tipomovimiento_id','=', 'movimientos.tipomovimiento_id');
                                        })
                            ->join('mercaderias', 'mercaderias.id', '=', 'movimientos.mercaderia_id')
                            ->where('movimientos.documento_id', '=', Input::get('documento_id'))
                            ->where('movimientos.tipomovimiento_id', '=', Input::get('tipomovimiento_id'))
                            ->where('movimientos.mercaderia_id', '=', Input::get('mercaderia_id'))
                            ->select('mercaderias.id', 'mercaderias.local_id', 'mercaderias.estado','mercaderias.preciocompra', 'mercaderias.precioventa', 'mercaderias.usuario_id')
                            ->get();


                if($mercaderias != null)
                {  
                    $cod = Input::get('mercaderia_id');
                    $ultimos = DB::select("SELECT movimientos.documento_id AS Numdoc, movimientos.tipomovimiento_id, tipomovimientos.destipomovimiento, locals.deslocal, documentos.fechadocumento 
                            from movimientos
                            INNER JOIN tipomovimientos ON tipomovimientos.id = movimientos.tipomovimiento_id
                            INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
                            INNER JOIN locals ON locals.id = documentos.localfin_id
                            WHERE movimientos.mercaderia_id = '$cod'
                            ORDER BY documentos.created_at DESC LIMIT 1");
                    return View::make('registroeliminar.registroeliminarregistro')
                            ->withInput('documento_id', 'tipomovimiento_id')
                            ->with('devuelves', $devuelves)
                            ->with('documentos', $documentos)
                            ->with('mercaderias', $mercaderias)
                            ->with('ultimos', $ultimos);
                }

                return View::make('registroeliminar.registroeliminar')->withErrors(['Número de mercadería no encontrado en documento solicitado']);
            }
            return View::make('registroeliminar.registroeliminar')->withErrors(['Número de documento o Tipo de movimiento incorrecto']);
        }
        return View::make('registroeliminar.registroeliminar');

    }



/*    public function consultamercaderia($cod)
    {
        //$mercaderia = Mercaderia::find($cod);
        $mercaderias = DB::select("SELECT movimientos.documento_id AS Numdoc, movimientos.tipomovimiento_id, tipomovimientos.destipomovimiento, locals.deslocal, documentos.fechadocumento 
                        from movimientos
                        INNER JOIN tipomovimientos ON tipomovimientos.id = movimientos.tipomovimiento_id
                        INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
                        INNER JOIN locals ON locals.id = documentos.localfin_id
                        WHERE movimientos.mercaderia_id = '$cod'
                        ORDER BY documentos.created_at");

        return View::make('registroagregar.consultamercaderia')->with('mercaderias', $mercaderias);

    }
*/

    public function registroeliminarregistro()
    {
        $data = Input::all();
        //busquemos movimiento anterior
        $num_mercaderia = Input::get('mercaderia_id');
        $ultimosmov = DB::select("SELECT movimientos.documento_id AS Numdoc, movimientos.tipomovimiento_id, tipomovimientos.destipomovimiento, locals.deslocal, documentos.fechadocumento, documentos.localfin_id 
                        from movimientos
                        INNER JOIN tipomovimientos ON tipomovimientos.id = movimientos.tipomovimiento_id
                        INNER JOIN documentos ON movimientos.documento_id=documentos.id AND movimientos.tipomovimiento_id=documentos.tipomovimiento_id
                        INNER JOIN locals ON locals.id = documentos.localfin_id
                        WHERE movimientos.mercaderia_id = '$num_mercaderia'
                        ORDER BY documentos.created_at desc LIMIT 2");  
        //d($ultimosmov);                  
        $localpenultimomov = $ultimosmov[1]->localfin_id; 

//dd( $localpenultimomov );
        DB::table('movimientos')->where('mercaderia_id', '=', Input::get('mercaderia_id'))
                                ->where('documento_id', '=', Input::get('documento_id'))
                                ->where('tipomovimiento_id', '=', Input::get('tipomovimiento_id'))
                                ->delete();
        $tipomovimiento_id = Input::get('tipomovimiento_id');
        if ($tipomovimiento_id == '3')
        {   
            DB::table('mercaderias')->where('id', '=', Input::get('mercaderia_id'))
                                    ->update(array('estado' => 'ACT', 'local_id' => $localpenultimomov, 'precioventa' => 0));
        }
        else
        {
            DB::table('mercaderias')->where('id', '=', Input::get('mercaderia_id'))
                                ->update(array('local_id' => $localpenultimomov));
        }

        return View::make('registroeliminar.registroeliminar')->withErrors(['Registro eliminado ....']);
    }



/*
    public function registroagregarventa()
    {
        $data = Input::all();

        DB::table('mercaderias')->where('id', '=', Input::get('mercaderia_id'))
                                ->update(array('estado' => 'VEN', 'precioventa' => Input::get('precioventaregistro')));
        //DB::table('movimientos')->insert(array('tipomovimiento_id' => '3', 'mercaderia_id' => Input::get('mercaderia_id'), 'documento_id' => Input::get('documento_id'))); 
        $movimiento = new Movimiento();
        $movimiento->mercaderia_id = Input::get('mercaderia_id');
        $movimiento->documento_id = Input::get('documento_id');
        $movimiento->tipomovimiento_id = 3; //cambio tipo movimiento
        $movimiento->flagoferta = 0;
        $movimiento->save();   
        return View::make('registroagregar.registroagregar');
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
        return View::make('registroagregar.registroagregar');
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
        return View::make('registroagregar.registroagregar');
    }
*/

}
?>
