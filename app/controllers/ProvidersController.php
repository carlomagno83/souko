<?php

class ProvidersController extends BaseController {

	/**
	 * Provider Repository
	 *
	 * @var Provider
	 */
	protected $provider;

	public function __construct(Provider $provider)
	{
		$this->provider = $provider;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$providers = $this->provider->all(); // modif para mostrar usuario
		$providers = $this->provider->join('users','providers.usuario_id','=','users.id')
                      ->select('providers.id',
                               'providers.codprovider3',
                               'providers.codprovider6',
                               'providers.desprovider',
                               'users.desusuario')
                      ->orderBy('providers.desprovider', 'asc')
                      ->get();

		return View::make('providers.index', compact('providers'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('providers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Provider::$rules);

		if ($validation->passes())
		{
			//usuario logueado
			$input['usuario_id'] = Auth::user()->id;			
			$this->provider->create($input);

			return Redirect::route('providers.index');
		}

		return Redirect::route('providers.create')
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
		$provider = $this->provider->findOrFail($id);

		return View::make('providers.show', compact('provider'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$provider = $this->provider->find($id);

		if (is_null($provider))
		{
			return Redirect::route('providers.index');
		}

		return View::make('providers.edit', compact('provider'));
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
		$validation = Validator::make($input, Provider::$rules);

		if ($validation->passes())
		{
			$provider = $this->provider->find($id);
			//usuario logueado
			$input['usuario_id'] = Auth::user()->id;			
			$provider->update($input);

			return Redirect::route('providers.show', $id);
		}

		return Redirect::route('providers.edit', $id)
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
		$this->provider->find($id)->delete();

		return Redirect::route('providers.index');
	}

}
