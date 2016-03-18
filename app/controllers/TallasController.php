<?php

class TallasController extends BaseController {

	/**
	 * Talla Repository
	 *
	 * @var Talla
	 */
	protected $talla;
	protected $rangos;

	public function __construct(Talla $talla)
	{
		$this->talla = $talla;

	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function llenacombo()
	{
		//$tallas = $this->talla->all();
		return "llena el combo";
		$rangos = $this2->rango->all();
		return View::make('tallas.index', compact('tallas'));
	}
	public function index()
	{
		//$tallas = $this->talla->all();
		$tallas = $this->talla->join('rangos','tallas.rango_id', '=', 'rangos.id')
								->select('tallas.id', 'tallas.codtalla3', 'tallas.codtalla6', 'tallas.destalla', 'tallas.usuario_id', 'rangos.desrango')
								->get();
		//$rangos->llenacombo();						
		return View::make('tallas.index', compact('tallas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tallas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Talla::$rules);

		if ($validation->passes())
		{
			$this->talla->create($input);

			return Redirect::route('tallas.index');
		}

		return Redirect::route('tallas.create')
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
		$talla = $this->talla->findOrFail($id);

		return View::make('tallas.show', compact('talla'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$talla = $this->talla->find($id);

		if (is_null($talla))
		{
			return Redirect::route('tallas.index');
		}

		return View::make('tallas.edit', compact('talla'));
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
		$validation = Validator::make($input, Talla::$rules);

		if ($validation->passes())
		{
			$talla = $this->talla->find($id);
			$talla->update($input);

			return Redirect::route('tallas.show', $id);
		}

		return Redirect::route('tallas.edit', $id)
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
		$this->talla->find($id)->delete();

		return Redirect::route('tallas.index');
	}

}
