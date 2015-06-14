<?php

class Talla extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'codtalla3' => 'required',
		'codtalla6' => 'required',
		'destalla' => 'required',
		'usuario_id' => 'required',
		'rango_id' => 'required'
	);

	public static function llenacombo()
    {
    	dd("prueba");
        return Rangos::orderBy('codrango6', 'asc')
            ->get();
    }
}
