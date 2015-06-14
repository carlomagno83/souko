<?php

class Mercaderia extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		//'producto_id' => 'required',
		//'mercaderiacambio_id' => 'required',
		//'local_id' => 'required',
		'estado' => 'required',
		//'usuario_id' => 'required'
	);
}
