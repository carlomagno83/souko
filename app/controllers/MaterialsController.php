<?php

class MaterialsController extends BaseController {

	/**
	 * Material Repository
	 *
	 * @var Material
	 */
	protected $material;

	public function __construct(Material $material)
	{
		$this->material = $material;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$materials = $this->material->all(); // modif para mostrar usuario
		$materials = $this->material->join('users','materials.usuario_id','=','users.id')
                      ->select('materials.id',
                               'materials.codmaterial3',
                               'materials.codmaterial6',
                               'materials.desmaterial',
                               'users.desusuario')
                      ->orderBy('materials.desmaterial', 'asc')
                      ->get();

		return View::make('materials.index', compact('materials'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('materials.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Material::$rules);

		if ($validation->passes())
		{
			$this->material->create($input);

			return Redirect::route('materials.index');
		}

		return Redirect::route('materials.create')
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
		$material = $this->material->findOrFail($id);

		return View::make('materials.show', compact('material'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$material = $this->material->find($id);

		if (is_null($material))
		{
			return Redirect::route('materials.index');
		}

		return View::make('materials.edit', compact('material'));
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
		$validation = Validator::make($input, Material::$rules);

		if ($validation->passes())
		{
			$material = $this->material->find($id);
			$material->update($input);

			return Redirect::route('materials.show', $id);
		}

		return Redirect::route('materials.edit', $id)
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
		$this->material->find($id)->delete();

		return Redirect::route('materials.index');
	}

}
