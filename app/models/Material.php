<?php

class Material extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'codmaterial3' => 'required',
//		'codmaterial6' => 'required',
		'desmaterial' => 'required',
		//'usuario_id' => 'required'
	);
}
