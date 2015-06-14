<?php

class Producto extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'provider_id' => 'required',
		'marca_id' => 'required',
		'tipo_id' => 'required',
		'modelo_id' => 'required',
		'color_id' => 'required',
		'rango_id' => 'required',
		'material_id' => 'required',
//		'desproducto' => 'required',
//		'codproducto21' => 'required',
//		'usuario_id' => 'required'
	);
}
