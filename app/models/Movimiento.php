<?php

class Movimiento extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'mercaderia_id' => 'required',
		'documento_id' => 'required',
		'flagoferta' => 'required'
	);
}
