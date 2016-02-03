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
		//$mercaderias = $this->mercaderia->all(); //cambios para mostrar la informacion
		$productos = DB::table('productos')->orderBy('codproducto31')->lists('codproducto31','id');
       	$locals = DB::table('locals')->orderBy('deslocal')->lists('deslocal','id');
       	$users = DB::table('users')->orderBy('username')->lists('username','id');

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

		return View::make('mercaderias.index', compact('mercaderias'))->with('productos',$productos)
   											->with('locals',$locals)
   											->with('users',$users);  											;
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
