<?php
use Illuminate\Http\Request;

class ProductosController extends BaseController {

	/**
	 * Producto Repository
	 *
	 * @var Producto
	 */
	protected $producto;

	public function __construct(Producto $producto)
	{
		$this->producto = $producto;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//filtro de busqueda
		//dd($request->get('marca_id'));
		$productos = Producto::find(0);
	//	$productos = $this->producto->all(); //cambio para mostrar datos



		return View::make('productos.index', compact('productos'));
	}

	/**
	 * Muestra los detalles filtrados.
	 *
	 * @return Response
	 */
	public function filtrar()
	{
		//Si no hay filtro
		//dd(Input::get('provider_id'));
		$tmptot = 0;
		$tmp1 = Input::get('provider_id');
		$tmp2 = Input::get('marca_id');
		$tmp3 = Input::get('tipo_id');
		$tmp4 = Input::get('modelo_id');
		$tmp5 = Input::get('color_id');
		$tmp6 = Input::get('material_id');
		$tmp7 = Input::get('rango_id');
		$tmptot = $tmp1 + $tmp2 + $tmp3 + $tmp4 + $tmp5 + $tmp6 + $tmp7 ;
		
		if( $tmptot == 0 ){

				$productos = Producto::where('provider_id','>',0);
				$productos = $productos->join('providers','productos.provider_id','=','providers.id')
									->join('marcas','productos.marca_id','=','marcas.id')
									->join('tipos','productos.tipo_id','=','tipos.id')
									->join('modelos','productos.modelo_id','=','modelos.id')
									->join('materials','productos.material_id','=','materials.id')
									->join('colors','productos.color_id','=','colors.id')
									->join('rangos','productos.rango_id','=','rangos.id')
                              ->select('productos.id',
                                       'productos.provider_id',
                                       'providers.codprovider3',
                                       'productos.marca_id',
                                       'productos.codproducto31',
                                       'productos.preciocompra',
                                       'productos.precioventa')
                              	->orderBy('providers.codprovider3')
								->orderBy('productos.codproducto31')
								->get();
			return View::make('productos.index')->with('productos',$productos);	


		}

       	//Si hay filtros
       	$productos = Producto::where('provider_id','>',0);
       	if(Input::get('provider_id')>0)
        	$productos = $productos->where('provider_id',Input::get('provider_id'));

       	if(Input::get('marca_id')>0)
        	$productos = $productos->where('marca_id',Input::get('marca_id'));

        if(Input::get('tipo_id')>0)
            $productos = $productos->where('tipo_id',Input::get('tipo_id'));

        if(Input::get('modelo_id')>0)
            $productos = $productos->where('modelo_id',Input::get('modelo_id'));

        if(Input::get('color_id')>0)
            $productos = $productos->where('color_id',Input::get('color_id'));

        if(Input::get('material_id')>0)
            $productos = $productos->where('material_id',Input::get('material_id'));

        if(Input::get('rango_id')>0)
            $productos = $productos->where('rango_id',Input::get('rango_id'));


		$productos = $productos->join('providers','productos.provider_id','=','providers.id')
									->join('marcas','productos.marca_id','=','marcas.id')
									->join('tipos','productos.tipo_id','=','tipos.id')
									->join('modelos','productos.modelo_id','=','modelos.id')
									->join('materials','productos.material_id','=','materials.id')
									->join('colors','productos.color_id','=','colors.id')
									->join('rangos','productos.rango_id','=','rangos.id')
                              	->select('productos.id',
                                       'productos.provider_id',
                                       'providers.codprovider3',
                                       'productos.codproducto31',
                                       'productos.preciocompra',
                                       'productos.precioventa')
                                ->orderBy('providers.codprovider3')
                                ->orderBy('productos.codproducto31')
								->get();

        return View::make('productos.index')->withInput('provider_id', 'marca_id', 'tipo_id', 'modelo_id', 'material_id', 'color_id' , 'rango_id')->with('productos',$productos);		

	}	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
       //agregar datos para los dropdown
		$providers = DB::table('providers')->orderBy('desprovider')->lists('desprovider','id');
		$marcas = DB::table('marcas')->orderBy('desmarca')->lists('desmarca','id');
       	$tipos = DB::table('tipos')->orderBy('destipo')->lists('destipo','id');
       	$modelos = DB::table('modelos')->orderBy('desmodelo')->lists('desmodelo','id');
       	$materials = DB::table('materials')->orderBy('desmaterial')->lists('desmaterial','id');
       	$colors = DB::table('colors')->orderBy('descolor')->lists('descolor','id');
       	$rangos = DB::table('rangos')->orderBy('desrango')->lists('desrango','id');
       	//usuario logueado
		//$usuario_id = Auth::user()->id;

       	return View::make('productos.create')->with('providers',$providers)
       										->with('marcas',$marcas)
   											->with('tipos',$tipos)
   											->with('modelos',$modelos)
   											->with('materials',$materials)
   											->with('colors',$colors)
   											->with('rangos',$rangos);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */



	public function store()
	{
		$input = Input::all();

		$validation = Validator::make($input, Producto::$rules);

		if ($validation->passes())
		{
			// etqta deberia llevar proveedor?
			//$providers = DB::table('providers')->select('codprovider3')->where('id', '=', $input["provider_id"])->pluck('codprovider3');
			$marcas = DB::table('marcas')->select('codmarca3')->where('id', '=', $input["marca_id"])->pluck('codmarca3');
			$tipos = DB::table('tipos')->select('codtipo8')->where('id', '=', $input["tipo_id"])->pluck('codtipo8');
			$modelos = DB::table('modelos')->select('codmodelo6')->where('id', '=', $input["modelo_id"])->pluck('codmodelo6');
			$materials = DB::table('materials')->select('codmaterial3')->where('id', '=', $input["material_id"])->pluck('codmaterial3');
			$colors = DB::table('colors')->select('codcolor6')->where('id', '=', $input["color_id"])->pluck('codcolor6');
			$rangos = DB::table('rangos')->select('codrango6')->where('id', '=', $input["rango_id"])->pluck('codrango6');

			//solo para una talla
			if ($input["talla_id"] != "")
				{
					$input["codproducto31"] = "$marcas"."-".
												"$tipos"."-".
												"$rangos"."-".												
												"$modelos"."-".
												"$materials"."-".
												"$colors"."-".
												$input["talla_id"];
					//usuario logueado
					$input['usuario_id'] = Auth::user()->id;
					$input = array_except($input, ['q']);
					$this->producto->create($input);
					//return Redirect::route('productos.index');
					return Redirect::route('productos.create')->withErrors(['Nuevo producto creado']);

				}
			// ok hasta aqui estamos bien hay que hacer un for 

			$rangofor = DB::table('rangos')->select('codrango6')->where('id', '=', $input["rango_id"])->pluck('codrango6');
			$desde = substr("$rangofor", -5,2);
			$hasta = substr("$rangofor", -2);
			//dd($hasta);
			for ($tallas = $desde; $tallas <= $hasta; $tallas++) 
			{
				$input["codproducto31"] = "$marcas"."-".
											"$tipos"."-".
											"$rangos"."-".
											"$modelos"."-".
											"$materials"."-".
											"$colors"."-".
											"$tallas";
				$input["talla_id"] = "$tallas";							
				//usuario logueado
				$input['usuario_id'] = Auth::user()->id;
				$input = array_except($input, ['q']);
				$this->producto->create($input);						
			}


			//$this->producto->create($input); //aqui solo registraba un solo dato hay q aumentar 
			//codproducto31 y un registro por cada talla

			//return Redirect::route('productos.index');
			return Redirect::route('productos.create')->withErrors(['Nuevo rango de productos creado']);
		}

		return Redirect::route('productos.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}
	

	public function editabloque()
	{
        $data = Input::all();

        foreach($data['producto_id'] as $key=>$value)
        {

//usuario logueado
                //dd($key2); //el key2 muestra el indice                       

                DB::table('productos')->where('id', '=', $data['producto_id'][$key])
									->update(array('precioventa' => $data['precioventa'][$key],
													'usuario_id' =>  Auth::user()->id
													));

        }
        return Redirect::route('productos.index')->withErrors(['Producto(s) editados']);
	}




	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$producto = $this->producto->findOrFail($id);

		return View::make('productos.show', compact('producto'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$producto = $this->producto->find($id);

		$providers = DB::table('providers')->lists('desprovider','id');

		if (is_null($producto))
		{
			return Redirect::route('productos.index');
		}

		return View::make('productos.edit', compact('producto'))
												->with('providers',$providers);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		//dd($input);
		$validation = Validator::make($input, Producto::$rules);

		if ($validation->passes())
		{
			$producto = $this->producto->find($id);
			//usuario logueado
			$input['usuario_id'] = Auth::user()->id;
			$input = array_except($input, ['q']); //error cambio al server
			$producto->update($input);

			return Redirect::route('productos.show', $id);
		}

		return Redirect::route('productos.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{ 

        $data = DB::table('mercaderias')->where("producto_id", "=", $id)->get();
        if ($data)
        {
        	//$this->filtrar();
			return Redirect::route('productos.index')->withErrors(['No se puede eliminar. Mercaderías existentes con este número de producto']);
        }
        else
        {	
			$this->producto->find($id)->delete();
			return Redirect::route('productos.index')->withErrors(['Producto eliminado']);
		}	
	}

	public function bajaexcel($id)
	{
		return "ingresaexcel";
		$input = Input::all();		
	}

	    public function search()
    {
        dd(Input::get('term'));
        $term = Input::get('term');

        $data = DB::table('productos')  
            ->where("marca_id","=","$term")
            ->select('id','RAZON_SOCIAL AS label','RAZON_SOCIAL AS value')
            ->get();


        $term = Input::get('term');
        $pag = Input::get('pag');
            

        //Formato
        /*$data = array(
                      array('id'=>'iddd','label'=>'laaa','value'=>'vaaa'),
                      array('id'=>'iddd','label'=>'laaa','value'=>'vaaa'),
                );*/

        return $data;

    }
}
