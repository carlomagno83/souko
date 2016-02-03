<?php

class Rango extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'codrango3' => 'required',
		'codrango6' => 'required',
		'desrango' => 'required',
		//'usuario_id' => 'required'
	);
}
