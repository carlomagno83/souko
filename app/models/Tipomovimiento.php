<?php

class Tipomovimiento extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'codtipomovimiento3' => 'required',
		'codtipomovimiento6' => 'required',
		'destipomovimiento' => 'required',
		'usuario_id' => 'required'
	);
}
