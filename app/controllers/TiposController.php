<?php

class TiposController extends BaseController {

	/**
	 * Tipo Repository
	 *
	 * @var Tipo
	 */
	protected $tipo;

	public function __construct(Tipo $tipo)
	{
		$this->tipo = $tipo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$tipos = $this->tipo->all(); // modif para mostrar usuario
		$tipos = $this->tipo->join('users','tipos.usuario_id','=','users.id')
                      ->select('tipos.id',
                               'tipos.codtipo3',
                               'tipos.codtipo8',
                               'tipos.destipo',
                               'users.desusuario')
                      ->orderBy('tipos.destipo', 'asc')
                      ->get();

		return View::make('tipos.index', compact('tipos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tipos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Tipo::$rules);

		if ($validation->passes())
		{
			//usuario logueado
			$input['usuario_id'] = Auth::user()->id;	
			$input = array_except($input, ['q']); //error cambio al server		
			$this->tipo->create($input);

			return Redirect::route('tipos.index');
		}

		return Redirect::route('tipos.create')
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
		$tipo = $this->tipo->findOrFail($id);

		return View::make('tipos.show', compact('tipo'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tipo = $this->tipo->find($id);

		if (is_null($tipo))
		{
			return Redirect::route('tipos.index');
		}

		return View::make('tipos.edit', compact('tipo'));
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
		$validation = Validator::make($input, Tipo::$rules);

		if ($validation->passes())
		{
			$tipo = $this->tipo->find($id);
			//usuario logueado
			$input['usuario_id'] = Auth::user()->id;
			$input = array_except($input, ['q']); //error cambio al server			
			$tipo->update($input);

			return Redirect::route('tipos.show', $id);
		}

		return Redirect::route('tipos.edit', $id)
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
		$this->tipo->find($id)->delete();

		return Redirect::route('tipos.index');
	}

}
