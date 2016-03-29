<?php

class MercaderiasController extends BaseController {

	/**
	 * Mercaderia Repository
	 *
	 * @var Mercaderia
	 */
	protected $mercaderia;

	public function __construct(Mercaderia $mercaderia)
	{
		$this->mercaderia = $mercaderia;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$mercaderias = Mercaderia::find(0);

		return View::make('mercaderias.index', compact('mercaderias'));  											;
	}

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
		$tmp8 = Input::get('local_id');
		$tmp9 = Input::get('estado_id');
		$tmptot = $tmp1 + $tmp2 + $tmp3 + $tmp4 + $tmp5 + $tmp6 + $tmp7 + $tmp8 + $tmp9 ;
		
		if( $tmptot == 0 ){

				$mercaderias = Mercaderia::where('producto_id','>',0);
				$mercaderias = $this->mercaderia->join('productos','mercaderias.producto_id','=','productos.id')
											->join('providers', 'productos.provider_id', '=', 'providers.id')
											->join('locals','mercaderias.local_id','=','locals.id')
											->join('users','mercaderias.usuario_id','=','users.id')
		                              ->select('mercaderias.id',
		                                       'mercaderias.producto_id',
		                                       'providers.codprovider3',
		                                       'productos.codproducto31',
		                                       'mercaderias.mercaderiacambio_id',
		                                       'mercaderias.local_id',
		                                       'locals.deslocal', 
		                                       'mercaderias.estado',
		                                       'mercaderias.preciocompra',                                      
		                                       'mercaderias.precioventa',
		                                       'mercaderias.usuario_id',
		                                       'users.desusuario')
		                              ->orderBy('mercaderias.id', 'asc')
		                              ->where('mercaderias.estado', '=', 'ACT')
		                              ->orwhere('mercaderias.estado', '=', 'INA')
		                              ->get();
			return View::make('mercaderias.index')->with('mercaderias',$mercaderias);	


		}

       	$condicion = "WHERE producto_id>0 ";
       	if( Input::get('provider_id') > 0 )
        	$condicion .= "AND provider_id=". Input::get('provider_id') ." ";

       	if( Input::get('marca_id') > 0 )
        	$condicion .= "AND marca_id=".Input::get('marca_id')." ";

        if(Input::get('tipo_id')>0)
            $condicion .= "AND tipo_id=". Input::get('tipo_id')." ";

        if(Input::get('modelo_id')>0)
            $condicion .= "AND modelo_id=".Input::get('modelo_id')." ";

        if(Input::get('color_id')>0)
            $condicion .= "AND color_id=".Input::get('color_id')." ";

        if(Input::get('material_id')>0)
            $condicion .= "AND material_id=".Input::get('material_id')." ";

        if(Input::get('rango_id')>0)
            $condicion .= "AND rango_id=".Input::get('rango_id')." ";

        if(Input::get('local_id')>0)
            $condicion .= "AND mercaderias.local_id=".Input::get('local_id')." ";

        if(Input::get('estado_id')<>"")
            $condicion .= "AND mercaderias.estado='".Input::get('estado_id')."' ";
//dd($condicion);

        		$sql = "SELECT mercaderias.id, mercaderias.producto_id, providers.codprovider3, productos.codproducto31, 
						mercaderias.local_id, locals.deslocal, mercaderias.estado, mercaderias.preciocompra, mercaderias.precioventa,
						mercaderias.usuario_id, users.desusuario
						from mercaderias
						INNER JOIN productos ON mercaderias.producto_id=productos.id
						INNER JOIN providers ON productos.provider_id=providers.id
						INNER JOIN locals ON mercaderias.local_id=locals.id
						INNER JOIN users ON mercaderias.usuario_id=users.id
						" .$condicion. "
						ORDER BY mercaderias.id ASC";
				$mercaderias = DB::select($sql);


			return View::make('mercaderias.index')->with('mercaderias',$mercaderias)->withInput('provider_id', 'marca_id', 'tipo_id', 'modelo_id', 'material_id', 'color_id' , 'rango_id', 'local_id', 'estado_id');	

//dd(Input::get('estado_id'));
/*       	//Si hay filtros
       	$mercaderias = Mercaderia::where('producto_id','>',0);
       	if(Input::get('provider_id')>0)
        	$mercaderias = $mercaderias->where('provider_id',Input::get('provider_id'));

       	if(Input::get('marca_id')>0)
        	$mercaderias = $mercaderias->where('marca_id',Input::get('marca_id'));

        if(Input::get('tipo_id')>0)
            $mercaderias = $mercaderias->where('tipo_id',Input::get('tipo_id'));

        if(Input::get('modelo_id')>0)
            $mercaderias = $mercaderias->where('modelo_id',Input::get('modelo_id'));

        if(Input::get('color_id')>0)
            $mercaderias = $mercaderias->where('color_id',Input::get('color_id'));

        if(Input::get('material_id')>0)
            $mercaderias = $mercaderias->where('material_id',Input::get('material_id'));

        if(Input::get('rango_id')>0)
            $mercaderias = $mercaderias->where('rango_id',Input::get('rango_id'));

        if(Input::get('local_id')>0)
            $mercaderias = $mercaderias->where('mercaderias.local_id',Input::get('local_id'));

        if(Input::get('estado_id')>0)
            $mercaderias = $mercaderias->where('mercaderias.estado_id',Input::get('estado_id'));
dd($mercaderias);
				$mercaderias = $this->mercaderia->join('productos','mercaderias.producto_id','=','productos.id')
											->join('providers', 'productos.provider_id', '=', 'providers.id')
											->join('locals','mercaderias.local_id','=','locals.id')
											->join('users','mercaderias.usuario_id','=','users.id')
		                              ->select('mercaderias.id',
		                                       'mercaderias.producto_id',
		                                       'providers.codprovider3',
		                                       'productos.codproducto31',
		                                       'mercaderias.mercaderiacambio_id',
		                                       'mercaderias.local_id',
		                                       'locals.deslocal', 
		                                       'mercaderias.estado',
		                                       'mercaderias.preciocompra',                                      
		                                       'mercaderias.precioventa',
		                                       'mercaderias.usuario_id',
		                                       'users.desusuario')
		                              ->orderBy('mercaderias.id', 'asc')

		                              ->get();
			return View::make('mercaderias.index')->with('mercaderias',$mercaderias)->withInput('provider_id', 'marca_id', 'tipo_id', 'modelo_id', 'material_id', 'color_id' , 'rango_id', 'local_id', 'estado_id');	
*/
	

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('mercaderias.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Mercaderia::$rules);

		if ($validation->passes())
		{
			//usuario logueado
			$input['usuario_id'] = Auth::user()->id;
			$this->mercaderia->create($input);

			return Redirect::route('mercaderias.index');
		}

		return Redirect::route('mercaderias.create')
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
		$mercaderia = $this->mercaderia->findOrFail($id);

		return View::make('mercaderias.show', compact('mercaderia'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$mercaderia = $this->mercaderia->find($id);
		$productos = DB::table('productos')->lists('codproducto31','id');
		$locals = DB::table('locals')->lists('deslocal','id');
		$users = DB::table('users')->lists('desusuario','id');

		if (is_null($mercaderia))
		{
			return Redirect::route('mercaderias.index');
		}

		//return View::make('mercaderias.edit', compact('mercaderia')); 
		//modif para vistas de editar
		return View::make('mercaderias.edit', compact('mercaderia'))->with('productos',$productos)
														->with('locals',$locals)
														->with('users',$users);

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
		$input = array_except($input, ['q']); //error cambio al server
		$validation = Validator::make($input, Mercaderia::$rules);

		if ($validation->passes())
		{
			$mercaderia = $this->mercaderia->find($id);
			//usuario logueado
			$input['usuario_id'] = Auth::user()->id;			
			$mercaderia->update($input);

			return Redirect::route('mercaderias.show', $id);
		}

		return Redirect::route('mercaderias.edit', $id)
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
		$this->mercaderia->find($id)->delete();

		return Redirect::route('mercaderias.index');
	}

}
