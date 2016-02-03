<?php

class LocalsController extends BaseController {

	/**
	 * Local Repository
	 *
	 * @var Local
	 */
	protected $local;

	public function __construct(Local $local)
	{
		$this->local = $local;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$locals = $this->local->all(); // modif para mostrar usuario
		$locals = $this->local->join('users','locals.usuario_id','=','users.id')
                      ->select('locals.id',
                               'locals.codlocal3',
                               'locals.codlocal6',
                               'locals.deslocal',
                               'users.desusuario')
                      ->orderBy('locals.deslocal', 'asc')
                      ->get();

		return View::make('locals.index', compact('locals'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('locals.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Local::$rules);

		if ($validation->passes())
		{
			//usuario logueado
			$input['usuario_id'] = Auth::user()->id;			
			$this->local->create($input);

			return Redirect::route('locals.index');
		}

		return Redirect::route('locals.create')
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
		$local = $this->local->findOrFail($id);

		return View::make('locals.show', compact('local'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$local = $this->local->find($id);

		if (is_null($local))
		{
			return Redirect::route('locals.index');
		}

		return View::make('locals.edit', compact('local'));
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
		$validation = Validator::make($input, Local::$rules);

		if ($validation->passes())
		{
			$local = $this->local->find($id);
			//usuario logueado
			$input['usuario_id'] = Auth::user()->id;			
			$local->update($input);

			return Redirect::route('locals.show', $id);
		}

		return Redirect::route('locals.edit', $id)
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
		$this->local->find($id)->delete();

		return Redirect::route('locals.index');
	}

}
