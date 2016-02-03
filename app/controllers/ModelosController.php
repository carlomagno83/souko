<?php

class ModelosController extends BaseController {

	/**
	 * Modelo Repository
	 *
	 * @var Modelo
	 */
	protected $modelo;

	public function __construct(Modelo $modelo)
	{
		$this->modelo = $modelo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$modelos = $this->modelo->all(); // modif para mostrar usuario
		$modelos = $this->modelo->join('users','modelos.usuario_id','=','users.id')
                      ->select('modelos.id',
                               'modelos.codmodelo3',
                               'modelos.codmodelo6',
                               'modelos.desmodelo',
                               'users.desusuario')
                      ->orderBy('modelos.desmodelo', 'asc')
                      ->get();

		return View::make('modelos.index', compact('modelos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('modelos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Modelo::$rules);

		if ($validation->passes())
		{
			//usuario logueado
			$input['usuario_id'] = Auth::user()->id;
			$this->modelo->create($input);

			return Redirect::route('modelos.index');
		}

		return Redirect::route('modelos.create')
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
		$modelo = $this->modelo->findOrFail($id);

		return View::make('modelos.show', compact('modelo'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$modelo = $this->modelo->find($id);

		if (is_null($modelo))
		{
			return Redirect::route('modelos.index');
		}

		return View::make('modelos.edit', compact('modelo'));
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
		$validation = Validator::make($input, Modelo::$rules);

		if ($validation->passes())
		{
			$modelo = $this->modelo->find($id);
			//usuario logueado
			$input['usuario_id'] = Auth::user()->id;			
			$modelo->update($input);

			return Redirect::route('modelos.show', $id);
		}

		return Redirect::route('modelos.edit', $id)
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
		$this->modelo->find($id)->delete();

		return Redirect::route('modelos.index');
	}

}
