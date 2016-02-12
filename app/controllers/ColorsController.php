<?php

class ColorsController extends BaseController {

	/**
	 * Color Repository
	 *
	 * @var Color
	 */
	protected $color;

	public function __construct(Color $color)
	{
		$this->color = $color;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$colors = $this->color->join('users','colors.usuario_id','=','users.id')
                              ->select('colors.id',
                                       'colors.codcolor3',
                                       'colors.codcolor6',
                                       'colors.descolor',
                                       'users.desusuario')
                              ->orderBy('colors.codcolor6', 'asc')
                              ->get();

        //$obj = new Color();
        //$obj->all();
        //$colors = Color::all();
		return View::make('colors.index', compact('colors'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

        $users = DB::table('users')->lists('desusuario','id');

		return View::make('colors.create')->with('users',$users);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Color::$rules);

		if ($validation->passes())
		{
			//usuario logueado
			$input['usuario_id'] = Auth::user()->id;
			$input = array_except($input, ['q']); //error cambio al server			
			$this->color->create($input);

			return Redirect::route('colors.index');
		}

		return Redirect::route('colors.create')
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
		$color = $this->color->findOrFail($id);

		return View::make('colors.show', compact('color'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$color = $this->color->find($id);
		$users = DB::table('users')->lists('desusuario','id');

		if (is_null($color))
		{
			return Redirect::route('colors.index');
		}

		//return View::make('colors.edit', compact('color')); //para agregar la vista de usuarios
		return View::make('colors.edit', compact('color'))->with('users',$users);
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

		//$users = DB::table('users')->where('id', '=', $input["usuario_id"])->get(); //para visualizar la descripcion de usuario

		$validation = Validator::make($input, Color::$rules);

		if ($validation->passes())
		{
			$color = $this->color->find($id);
			//usuario logueado
			$input['usuario_id'] = Auth::user()->id;	
			$input = array_except($input, ['q']); //error cambio al server		
			$color->update($input);

          	return Redirect::route('colors.show', $id);
		}

		return Redirect::route('colors.edit', $id)
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

		$this->color->find($id)->delete();

		return Redirect::route('colors.index');
	}

}
