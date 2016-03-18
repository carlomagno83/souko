<?php

class Modelo extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		//'codmodelo3' => 'required',
		'codmodelo6' => 'required',
		'desmodelo' => 'required',
		//'usuario_id' => 'required'
	);
}
