<?php

class LiquidacionguiadevController extends BaseController {

	public function index()
	{
		return View::make('liquidacionguiadev.liquidacionguiadev');
	}

	public function ingreso()
	{
		//return "ingreso";
		//$documentos = $this->documento->all();
		//return View::make('documentos.ingresoproveedor', compact('documentos'));
		return View::make('liquidacionguiadev.liquidacionguiadev');

		//C:\xampp\htdocs\almacen\app\views\documentos\ingresoproveedor.blade.php
	}

	/* modificar public function graba()
	{

	}*/
}	
?>
