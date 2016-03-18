<?php

class DocumentosController extends BaseController {

	/**
	 * Documento Repository
	 *
	 * @var Documento
	 */
	protected $documento;

	public function __construct(Documento $documento)
	{
		$this->documento = $documento;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$documentos = $this->documento->all();

		return View::make('documentos.index', compact('documentos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('documentos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Documento::$rules);

		if ($validation->passes())
		{
			$this->documento->create($input);

			return Redirect::route('documentos.index');
		}

		return Redirect::route('documentos.create')
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
		$documento = $this->documento->findOrFail($id);

		return View::make('documentos.show', compact('documento'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$documento = $this->documento->find($id);

		if (is_null($documento))
		{
			return Redirect::route('documentos.index');
		}

		return View::make('documentos.edit', compact('documento'));
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
		$validation = Validator::make($input, Documento::$rules);

		if ($validation->passes())
		{
			$documento = $this->documento->find($id);
			$documento->update($input);

			return Redirect::route('documentos.show', $id);
		}

		return Redirect::route('documentos.edit', $id)
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
		$this->documento->find($id)->delete();

		return Redirect::route('documentos.index');
	}

}
