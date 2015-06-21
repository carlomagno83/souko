<?php

class UsersController extends BaseController {

	/**
	 * User Repository
	 *
	 * @var User
	 */
	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->user->all(); 
		return View::make('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$input['password']=Hash::make($input['password']);

		$validation = Validator::make($input, User::$rules);

		if ($validation->passes())
		{
			$user = new User();			
			$user->username = Input::get('username');
			$user->desusuario = Input::get('desusuario');		
			$user->rolusuario = Input::get('rolusuario');		
			$user->password = Hash::make(Input::get('password'));		
			$user->usuario_id = Input::get('usuario_id');
			$user->save();

			//$this->user->create($input); obviar el modo automatico

			return Redirect::route('users.index');
		}

		return Redirect::route('users.create')
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
		$user = $this->user->findOrFail($id);

		return View::make('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = $this->user->find($id);

		if (is_null($user))
		{
			return Redirect::route('users.index');
		}
		return View::make('users.edit', compact('user'));
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
		$validation = Validator::make($input, User::$rules);

		if ($validation->passes())
		{
			$user = User::find($id);	
			$user->username = Input::get('username');
			$user->desusuario = Input::get('desusuario');		
			$user->rolusuario = Input::get('rolusuario');		
			$user->password = Hash::make(Input::get('password'));		
			$user->usuario_id = Input::get('usuario_id');

			$user->save();
			//$user->update($input); //evitar el modo automatico

			return Redirect::route('users.show', $id);
		}

		return Redirect::route('users.edit', $id)
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
		$this->user->find($id)->delete();

		return Redirect::route('users.index');
	}

}
