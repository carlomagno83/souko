<?php

class Tipo extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
//		'codtipo3' => 'required',
		'codtipo8' => 'required',
		'destipo' => 'required',
		'usuario_id' => 'required'
	);
}
