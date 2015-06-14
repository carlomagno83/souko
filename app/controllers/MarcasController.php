<?php

class MarcasController extends BaseController {

	/**
	 * Marca Repository
	 *
	 * @var Marca
	 */
	protected $marca;

	public function __construct(Marca $marca)
	{
		$this->marca = $marca;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$marcas = $this->marca->join('users','marcas.usuario_id','=','users.id')
                              ->select('marcas.id',
                                       'marcas.codmarca3',
                                       'marcas.codmarca6',
                                       'marcas.desmarca',
                                       'users.desusuario')
                              ->orderBy('marcas.codmarca3', 'asc')
                              ->get();

		return View::make('marcas.index', compact('marcas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//return View::make('marcas.create');
		$users = DB::table('users')->lists('desusuario','id');

		return View::make('marcas.create')->with('users',$users);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Marca::$rules);

		if ($validation->passes())
		{
			$this->marca->create($input);

			return Redirect::route('marcas.index');
		}

		return Redirect::route('marcas.create')
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
		$marca = $this->marca->findOrFail($id);

		return View::make('marcas.show', compact('marca'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$marca = $this->marca->find($id);

		if (is_null($marca))
		{
			return Redirect::route('marcas.index');
		}

		return View::make('marcas.edit', compact('marca'));
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
		$validation = Validator::make($input, Marca::$rules);

		if ($validation->passes())
		{
			$marca = $this->marca->find($id);
			$marca->update($input);

			return Redirect::route('marcas.show', $id);
		}

		return Redirect::route('marcas.edit', $id)
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
		$this->marca->find($id)->delete();

		return Redirect::route('marcas.index');
	}

}
