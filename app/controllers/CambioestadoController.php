<?php

class CambioestadoController extends BaseController {

    /**
     * CAmbio Repository
     *
     * @var Cambio
     */
    protected $cambio;
   	protected $mercaderia;
    public function __construct(Cambio $cambio, Mercaderia $mercaderia)
    {
        $this->cambio = $cambio;
        $this->mercaderia = $mercaderia;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 public function index()
	{
//dd("ingresa");
	        //$tempos = DB::table('tempos')->where('usuario_id','=',Auth::user()->id)->get();
	        $cambios = DB::table('cambios')->where('usuario_id','=',Auth::user()->id )->get();
			return View::make('cambioestado.cambioestado')->with('cambios', $cambios);

	}

	public function agregareg()
	{
		$data = Input::all();
        //dd($data);
	    if(Input::get('mercaderia_id')!=null) 
        {
        	//verifica data ingresada
	        $existedata = DB::table('cambios')->select('codproducto31')->where('mercaderia_id', '=', Input::get('mercaderia_id'))->where('usuario_id','=',Auth::user()->id )->pluck('codproducto31');
			if(is_null($existedata))
	        {	
	        	$encuentra = DB::table('mercaderias')->select('estado')->where('id', '=', Input::get('mercaderia_id'))->pluck('estado');
                //dd($encuentra);
	            if($encuentra != null)
	            {


if ($encuentra=="ACT" OR $encuentra=="INA")
{	

                    if ($encuentra)

	                {
		                $producto_id = DB::table('mercaderias')->select('producto_id')->where('id', '=', Input::get('mercaderia_id'))->pluck('producto_id');
		                $codproducto31 =  DB::table('productos')->select('codproducto31')->where('id', '=', $producto_id)->pluck('codproducto31');
		         		//$deslocal = DB::table('locals')->join('mercaderias', 'locals.id', '=', 'mercaderias.local_id')->select('deslocal')->where('mercaderias.id','=', Input::get('mercaderia_id'))->pluck('deslocal');
                        $deslocal = DB::table('locals')->join('mercaderias', 'locals.id', '=', 'mercaderias.local_id')->select('codlocal3')->where('mercaderias.id','=', Input::get('mercaderia_id'))->pluck('codlocal3');
		         		$estado = DB::table('mercaderias')->select('estado')->where('mercaderias.id','=', Input::get('mercaderia_id'))->pluck('estado');
		                
				        $cambio = new Cambio();
				        $cambio->mercaderia_id = Input::get('mercaderia_id');
				        $cambio->producto_id = $producto_id;
				        $cambio->codproducto31 = $codproducto31;
				        $cambio->deslocal = $deslocal;
				        $cambio->estado = $estado;
				        $cambio->usuario_id = Auth::user()->id; //usuario logueado 
				        $cambio->save();

			        	$cambios = DB::table('cambios')->where('usuario_id','=',Auth::user()->id )->get();

						return View::make('cambioestado.cambioestado')->withInput('usuario_id', 'local_id')->with('cambios', $cambios);
					}	
}	
else
{
	if(Auth::user()->rolusuario=='SUPER')
	{
                    if ($encuentra)

	                {
		                $producto_id = DB::table('mercaderias')->select('producto_id')->where('id', '=', Input::get('mercaderia_id'))->pluck('producto_id');
		                $codproducto31 =  DB::table('productos')->select('codproducto31')->where('id', '=', $producto_id)->pluck('codproducto31');
		         		//$deslocal = DB::table('locals')->join('mercaderias', 'locals.id', '=', 'mercaderias.local_id')->select('deslocal')->where('mercaderias.id','=', Input::get('mercaderia_id'))->pluck('deslocal');
                        $deslocal = DB::table('locals')->join('mercaderias', 'locals.id', '=', 'mercaderias.local_id')->select('codlocal3')->where('mercaderias.id','=', Input::get('mercaderia_id'))->pluck('codlocal3');
		         		$estado = DB::table('mercaderias')->select('estado')->where('mercaderias.id','=', Input::get('mercaderia_id'))->pluck('estado');
		                
				        $cambio = new Cambio();
				        $cambio->mercaderia_id = Input::get('mercaderia_id');
				        $cambio->producto_id = $producto_id;
				        $cambio->codproducto31 = $codproducto31;
				        $cambio->deslocal = $deslocal;
				        $cambio->estado = $estado;
				        $cambio->usuario_id = Auth::user()->id; //usuario logueado 
				        $cambio->save();

			        	$cambios = DB::table('cambios')->where('usuario_id','=',Auth::user()->id )->get();

						return View::make('cambioestado.cambioestado')->withInput('usuario_id', 'local_id')->with('cambios', $cambios);
					}	


	}	
	else
	{
		$cambios = DB::table('cambios')->where('usuario_id','=',Auth::user()->id )->get();	
		return View::make('cambioestado.cambioestado')->withInput('usuario_id', 'local_id')->with('cambios', $cambios)->withErrors(['Estado de la mercaderia no es ACT o INA']);		
	}	
				
}				
	            }
	        }    
        } 

        $cambios = DB::table('cambios')->where('usuario_id','=',Auth::user()->id)->get();
        //usuario logueado
		return View::make('cambioestado.cambioestado')->withInput('usuario_id', 'local_id')->with('cambios', $cambios);
	}

	public function getDelete($mercaderia_id)
	{
		//data = Input::all();
		DB::table('cambios')->where('mercaderia_id', '=', $mercaderia_id)->delete();

        $cambios = DB::table('cambios')->where('usuario_id','=',Auth::user()->id )->get();//usuario logueado
		return View::make('cambioestado.cambioestado')->withInput('usuario_id', 'local_id')->with('cambios', $cambios);
	}

    public function store()
    {
        
        $cambios = DB::table('cambios')->where('usuario_id','=',Auth::user()->id )->get();//usuario logueado
        if(count($cambios)==0){
            return View::make('cambioestado.cambioestado')->with('cambios', $cambios);
        }

        $data = Input::all();
        //dd(Auth::user()->id);
        // hay que agregar un control de txn
        
        foreach($data['mercaderia_id'] as $key=>$value)
        {
            //actualiza el estado de la mercaderia
            DB::table('mercaderias')->where('id', '=', $data['mercaderia_id'][$key])->update(array('estado' => $data['estado'], 'usuario_id' => Auth::user()->id));
        }

        DB::table('cambios')->where('usuario_id', '=', Auth::user()->id )->delete(); 
        //Ya no realiza por la func de impresion
	   	$cambios = DB::table('cambios')->where('usuario_id','=', Auth::user()->id )->get();//usuario logueado
		return View::make('cambioestado.cambioestado')->withErrors(['Estado de mercaderia actualizado'])->withInput('usuario_id', 'local_id')->with('cambios', $cambios);

    }



}	
?>
