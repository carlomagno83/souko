<?php

class Color extends Eloquent {

	protected $guarded = array();

	public static $rules = array(
		//'codcolor3' => 'required',
		'codcolor6' => 'required',
		'descolor' => 'required',
		//'usuario_id' => 'required'
	);
}
