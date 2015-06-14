<?php

class Documento extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'fechadocumento' => 'required',
		'tipomovimiento_id' => 'required',
		'localini_id' => 'required',
		'localfin_id' => 'required',
		'flagestado' => 'required',
		'usuario_id' => 'required'
	);
}
