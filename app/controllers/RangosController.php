<?php

class RangosController extends BaseController {

	/**
	 * Rango Repository
	 *
	 * @var Rango
	 */
	protected $rango;

	public function __construct(Rango $rango)
	{
		$this->rango = $rango;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$rangos = $this->rango->all(); // modif para mostrar usuario
		$rangos = $this->rango->join('users','rangos.usuario_id','=','users.id')
                      ->select('rangos.id',
                               'rangos.codrango3',
                               'rangos.codrango6',
                               'rangos.desrango',
                               'users.desusuario')
                      ->orderBy('rangos.desrango', 'asc')
                      ->get();

		return View::make('rangos.index', compact('rangos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('rangos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Rango::$rules);

		if ($validation->passes())
		{
			$this->rango->create($input);

			return Redirect::route('rangos.index');
		}

		return Redirect::route('rangos.create')
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
		$rango = $this->rango->findOrFail($id);

		return View::make('rangos.show', compact('rango'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$rango = $this->rango->find($id);

		if (is_null($rango))
		{
			return Redirect::route('rangos.index');
		}

		return View::make('rangos.edit', compact('rango'));
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
		$validation = Validator::make($input, Rango::$rules);

		if ($validation->passes())
		{
			$rango = $this->rango->find($id);
			$rango->update($input);

			return Redirect::route('rangos.show', $id);
		}

		return Redirect::route('rangos.edit', $id)
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
		$this->rango->find($id)->delete();

		return Redirect::route('rangos.index');
	}

}
