<?php

class TipomovimientosController extends BaseController {

	/**
	 * Tipomovimiento Repository
	 *
	 * @var Tipomovimiento
	 */
	protected $tipomovimiento;

	public function __construct(Tipomovimiento $tipomovimiento)
	{
		$this->tipomovimiento = $tipomovimiento;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tipomovimientos = $this->tipomovimiento->all();

		return View::make('tipomovimientos.index', compact('tipomovimientos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tipomovimientos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Tipomovimiento::$rules);

		if ($validation->passes())
		{
			$this->tipomovimiento->create($input);

			return Redirect::route('tipomovimientos.index');
		}

		return Redirect::route('tipomovimientos.create')
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
		$tipomovimiento = $this->tipomovimiento->findOrFail($id);

		return View::make('tipomovimientos.show', compact('tipomovimiento'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tipomovimiento = $this->tipomovimiento->find($id);

		if (is_null($tipomovimiento))
		{
			return Redirect::route('tipomovimientos.index');
		}

		return View::make('tipomovimientos.edit', compact('tipomovimiento'));
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
		$validation = Validator::make($input, Tipomovimiento::$rules);

		if ($validation->passes())
		{
			$tipomovimiento = $this->tipomovimiento->find($id);
			$tipomovimiento->update($input);

			return Redirect::route('tipomovimientos.show', $id);
		}

		return Redirect::route('tipomovimientos.edit', $id)
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
		$this->tipomovimiento->find($id)->delete();

		return Redirect::route('tipomovimientos.index');
	}

}
