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

       	//Si hay filtros

		if(Input::get('provider_id')>0){
            $datoprovider = Input::get('provider_id');
        }
        else{
            $datoprovider = " '>', 0";
        }

		if(Input::get('marca_id')>0){
            $datomarca = Input::get('marca_id');
        }
        else{
            $datomarca = " '>', 0";
        }

		if(Input::get('tipo_id')>0){
            $datotipo = Input::get('tipo_id');
        }
        else{
            $datotipo = " '>', 0";
        }

		if(Input::get('modelo_id')>0){
            $datomodelo = Input::get('modelo_id');
        }
        else{
            $datomodelo = " '>', 0";
        }

		if(Input::get('color_id')>0){
            $datocolor = Input::get('color_id');
        }
        else{
            $datocolor = " '>', 0";
        }

		if(Input::get('material_id')>0){
            $datomaterial = Input::get('material_id');
        }
        else{
            $datomaterial = " '>', 0";
        }

		if(Input::get('rango_id')>0){
            $datorango = Input::get('rango_id');
        }
        else{
            $datorango = " '>', 0";
        }


		$productos = $this->producto->join('providers','productos.provider_id','=','providers.id')
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
                                       'marcas.codmarca3',
                                       'productos.tipo_id',
                                       'tipos.codtipo8',                                       
                                       'productos.modelo_id',
                                       'modelos.codmodelo6',
                                       'productos.material_id',
                                       'materials.codmaterial3',
                                       'productos.color_id',
                                       'colors.codcolor6',
                                       'productos.rango_id',
                                       'rangos.codrango3',
                                       'productos.talla_id',
                                       'productos.codproducto31',
                                       'productos.preciocompra',
                                       'productos.precioventa')

                              ->where('provider_id', $datoprovider)
                              ->where('marca_id', $datomarca)
                              ->where('tipo_id', $datotipo)
                              ->where('modelo_id', $datomodelo)
                              ->where('color_id', $datocolor)
                              ->where('material_id', $datomaterial)
                              ->where('rango_id', $datorango)
                              ->orderBy('productos.codproducto31', 'asc')                              
                              ->get();

		return View::make('productos.index', compact('productos'));


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
			$rangos = DB::table('rangos')->select('codrango3')->where('id', '=', $input["rango_id"])->pluck('codrango3');

			//solo para una talla
			if ($input["talla_id"] != "")
				{
					$input["codproducto31"] = "$marcas"."-".
												"$tipos"."-".
												"$modelos"."-".
												"$materials"."-".
												"$colors"."-".
												"$rangos"."-".
												$input["talla_id"];
					
					$this->producto->create($input);
					return Redirect::route('productos.index');

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
											"$modelos"."-".
											"$materials"."-".
											"$colors"."-".
											"$rangos"."-".
											"$tallas";
				$input["talla_id"] = "$tallas";							
	
				$this->producto->create($input);						
			}


			//$this->producto->create($input); //aqui solo registraba un solo dato hay q aumentar 
			//codproducto31 y un registro por cada talla

			return Redirect::route('productos.index');
		}

		return Redirect::route('productos.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
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
		$this->producto->find($id)->delete();

		return Redirect::route('productos.index');
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
