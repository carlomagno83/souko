<?php

class Local extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'codlocal3' => 'required',
		'codlocal6' => 'required',
		'deslocal' => 'required',
		//'usuario_id' => 'required'
	);
}
