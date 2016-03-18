<?php

class Estado extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'codestado3' => 'required',
		'codestado6' => 'required',
		'desestado' => 'required',
		'usuario_id' => 'required'
	);
}
