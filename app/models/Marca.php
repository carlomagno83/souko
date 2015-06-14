<?php

class Marca extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'codmarca3' => 'required',
		//'codmarca6' => 'required',
		'desmarca' => 'required',
		'usuario_id' => 'required'
	);
}
