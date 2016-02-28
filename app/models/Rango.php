<?php

class Rango extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'codrango6' => 'required',
		'desrango' => 'required',
		//'usuario_id' => 'required'
	);
}
