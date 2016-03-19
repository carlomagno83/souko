<?php

class MovimientosController extends BaseController {

	/**
	 * Movimiento Repository
	 *
	 * @var Movimiento
	 */
	protected $movimiento;

	public function __construct(Movimiento $movimiento)
	{
		$this->movimiento = $movimiento;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$movimientos = $this->movimiento->all();

		return View::make('movimientos.index', compact('movimientos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('movimientos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Movimiento::$rules);

		if ($validation->passes())
		{
			$this->movimiento->create($input);

			return Redirect::route('movimientos.index');
		}

		return Redirect::route('movimientos.create')
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
		$movimiento = $this->movimiento->findOrFail($id);

		return View::make('movimientos.show', compact('movimiento'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$movimiento = $this->movimiento->find($id);

		if (is_null($movimiento))
		{
			return Redirect::route('movimientos.index');
		}

		return View::make('movimientos.edit', compact('movimiento'));
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
		$validation = Validator::make($input, Movimiento::$rules);

		if ($validation->passes())
		{
			$movimiento = $this->movimiento->find($id);
			$movimiento->update($input);

			return Redirect::route('movimientos.show', $id);
		}

		return Redirect::route('movimientos.edit', $id)
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
		$this->movimiento->find($id)->delete();

		return Redirect::route('movimientos.index');
	}

}
