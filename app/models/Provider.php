<?php

class Provider extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'codprovider3' => 'required',
		'codprovider6' => 'required',
		'desprovider' => 'required',
		//'usuario_id' => 'required'
	);
}
